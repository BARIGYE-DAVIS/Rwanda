<?php

namespace App\Http\Controllers;

use App\Models\SeoPage;
use App\Models\SeoPageBlock;
use App\Models\SeoPageImage;
use App\Models\SeoPageLink;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class SeoPageController extends Controller
{
    // ── INDEX ─────────────────────────────────────────────
public function index(Request $request)
{
    $query = SeoPage::query();
    
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('slug', 'like', "%{$search}%")
              ->orWhere('focus_keyword', 'like', "%{$search}%");
        });
    }
    
    $pages = $query->orderBy('created_at', 'desc')->get();
    
    if ($request->ajax()) {
        $html = view('admin.seo_pages.partials.pages-table', ['pages' => $pages])->render();
        
        return response()->json([
            // 'html' => $html,
            'stats' => [
                'total' => $pages->count(),
                'published' => $pages->where('status', 'published')->count(),
                'drafts' => $pages->where('status', 'draft')->count(),
                'archived' => $pages->where('status', 'archived')->count(),
            ]
        ]);
    }
    
    return view('admin.seo_pages.index', compact('pages'));
}

    // ── CREATE ────────────────────────────────────────────
    public function create()
    {
        return view('admin.seo_pages.create');
    }

    // ── STORE ─────────────────────────────────────────────
    public function store(Request $request)
    {
        $this->validatePageData($request);

        $featuredImagePath = $this->handleFeaturedImageUpload($request, null);

        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);

        $page = SeoPage::create([
            'title'            => $request->title,
            'slug'             => $slug,
            'meta_description' => $request->meta_description,
            'focus_keyword'    => $request->focus_keyword,
            'featured_image'   => $featuredImagePath,
            'status'           => $request->status,
        ]);

        $this->saveBlocks($page->id, $request->blocks ?? []);

        return redirect()->route('admin.seo-pages.index')
            ->with('success', 'SEO page created successfully.');
    }

    // ── EDIT ──────────────────────────────────────────────
    public function edit(SeoPage $seoPage)
    {
        $seoPage->load(['blocks.images', 'blocks.links']);
        return view('admin.seo_pages.edit', compact('seoPage'));
    }

    // ── UPDATE ────────────────────────────────────────────
    public function update(Request $request, SeoPage $seoPage)
    {
        $this->validatePageData($request, $seoPage->id);

        $featuredImagePath = $this->handleFeaturedImageUpload($request, $seoPage);

        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);

        $seoPage->update([
            'title'            => $request->title,
            'slug'             => $slug,
            'meta_description' => $request->meta_description,
            'focus_keyword'    => $request->focus_keyword,
            'featured_image'   => $featuredImagePath,
            'status'           => $request->status,
        ]);

        $this->syncBlocks($seoPage, $request->blocks ?? []);

        return redirect()->route('admin.seo-pages.index')
            ->with('success', 'SEO page updated successfully.');
    }

    // ── TOGGLE STATUS ─────────────────────────────────────
    public function toggleStatus(SeoPage $seoPage)
    {
        $seoPage->update([
            'status' => $seoPage->status === 'published' ? 'archived' : 'published',
        ]);

        return redirect()->route('admin.seo-pages.index')
            ->with('success', 'Page status updated.');
    }

    // ── DESTROY ───────────────────────────────────────────
    public function destroy(SeoPage $seoPage)
    {
        if ($seoPage->featured_image) {
            $this->deleteImage($seoPage->featured_image);
        }

        foreach ($seoPage->blocks as $block) {
            foreach ($block->images as $image) {
                $this->deleteImage($image->image_path);
            }
        }

        $seoPage->delete();

        return redirect()->route('admin.seo-pages.index')
            ->with('success', 'SEO page deleted successfully.');
    }

    // ── PUBLIC SHOW ───────────────────────────────────────
    public function show($slug)
    {
        $page = SeoPage::where('slug', $slug)
            ->where('status', 'published')
            ->with(['blocks.images', 'blocks.links'])
            ->firstOrFail();

        return view('seo_pages.show', compact('page'));
    }

    // ──────────────────────────────────────────────────────
    // PRIVATE METHODS
    // ──────────────────────────────────────────────────────

    private function validatePageData(Request $request, ?int $pageId = null): void
    {
        $slugUnique = $pageId 
            ? 'unique:seo_pages,slug,' . $pageId 
            : 'unique:seo_pages,slug';

        $request->validate([
            'title'                     => 'required|string|max:255',
            'slug'                      => 'nullable|string|max:255|' . $slugUnique,
            'meta_description'          => 'nullable|string|max:320',
            'focus_keyword'             => 'nullable|string|max:255',
            'featured_image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3048',
            'status'                    => 'required|in:draft,published,archived',
            'blocks'                    => 'nullable|array',
            'blocks.*.type'             => 'required|in:text,heading,image,links',
            'blocks.*.content'          => 'nullable|string',
            'blocks.*.heading_level'    => 'nullable|in:h1,h2,h3,h4,h5,h6',
            'blocks.*.images'           => 'nullable|array',
            'blocks.*.images.*'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3048',
            'blocks.*.replace_images'   => 'nullable|array',
            'blocks.*.replace_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3048',
            'blocks.*.delete_images'    => 'nullable|array',
            'blocks.*.delete_images.*'  => 'nullable|string',
            'blocks.*.alts'             => 'nullable|array',
            'blocks.*.existing_images'  => 'nullable|array',
            'blocks.*.existing_images.*'=> 'nullable|exists:seo_page_images,id',
            'blocks.*.link_texts'       => 'nullable|array',
            'blocks.*.link_urls'        => 'nullable|array',
            'blocks.*.link_texts.*'     => 'nullable|string|max:255',
            'blocks.*.link_urls.*'      => 'nullable|url|max:500',
        ]);
    }

    private function handleFeaturedImageUpload(Request $request, ?SeoPage $seoPage): ?string
    {
        if (!$request->hasFile('featured_image')) {
            return $seoPage?->featured_image;
        }

        // Delete old image if exists
        if ($seoPage && $seoPage->featured_image) {
            $this->deleteImage($seoPage->featured_image);
        }

        return $this->storeImage($request->file('featured_image'), 'seo_pages/featured');
    }

    private function saveBlocks(int $pageId, array $blocksData): void
    {
        foreach ($blocksData as $sortOrder => $blockData) {
            $this->createBlock($pageId, $blockData, $sortOrder);
        }
    }

    private function syncBlocks(SeoPage $page, array $blocksData): void
    {
        // Get existing blocks
        $existingBlockIds = $page->blocks->pluck('id')->toArray();
        $newBlockIds = [];

        foreach ($blocksData as $sortOrder => $blockData) {
            $blockId = $blockData['id'] ?? null;

            if ($blockId && in_array($blockId, $existingBlockIds)) {
                // Update existing block
                $this->updateBlock($page, $blockId, $blockData, $sortOrder);
                $newBlockIds[] = $blockId;
            } else {
                // Create new block
                $block = $this->createBlock($page->id, $blockData, $sortOrder);
                $newBlockIds[] = $block->id;
            }
        }

        // Delete blocks that were not in the request
        $blocksToDelete = array_diff($existingBlockIds, $newBlockIds);
        foreach ($blocksToDelete as $blockId) {
            $block = SeoPageBlock::find($blockId);
            if ($block) {
                foreach ($block->images as $image) {
                    $this->deleteImage($image->image_path);
                }
                $block->delete();
            }
        }
    }

    private function createBlock(int $pageId, array $blockData, int $sortOrder): SeoPageBlock
    {
        $block = SeoPageBlock::create([
            'seo_page_id'   => $pageId,
            'block_type'    => $blockData['type'],
            'heading_level' => $blockData['type'] === 'heading'
                                ? ($blockData['heading_level'] ?? 'h2')
                                : null,
            'content'       => in_array($blockData['type'], ['text', 'heading'])
                                ? ($blockData['content'] ?? null)
                                : null,
            'sort_order'    => $sortOrder,
        ]);

        if ($blockData['type'] === 'image') {
            $this->syncBlockImages($block, $blockData);
        }

        if ($blockData['type'] === 'links') {
            $this->syncBlockLinks($block, $blockData);
        }

        return $block;
    }

    private function updateBlock(SeoPage $page, int $blockId, array $blockData, int $sortOrder): void
    {
        $block = SeoPageBlock::find($blockId);

        if (!$block) {
            return;
        }

        $block->update([
            'heading_level' => $blockData['type'] === 'heading'
                                ? ($blockData['heading_level'] ?? 'h2')
                                : null,
            'content'       => in_array($blockData['type'], ['text', 'heading'])
                                ? ($blockData['content'] ?? null)
                                : null,
            'sort_order'    => $sortOrder,
        ]);

        if ($blockData['type'] === 'image') {
            $this->syncBlockImages($block, $blockData);
        }

        if ($blockData['type'] === 'links') {
            $this->syncBlockLinks($block, $blockData);
        }
    }

    private function syncBlockImages(SeoPageBlock $block, array $blockData): void
    {
        // Get existing image IDs
        $existingImageIds = $block->images->pluck('id')->toArray();

        // Marked for deletion
        $deleteImageIds = $blockData['delete_images'] ?? [];
        $deleteImageIds = array_filter($deleteImageIds);

        // Keep track of images that remain
        $remainingImageIds = [];

        // Process existing images (update alt text, replace files)
        $existingImagesData = $blockData['existing_images'] ?? [];
        $replaceImagesData = $blockData['replace_images'] ?? [];
        $altTextsData = $blockData['alts'] ?? [];

        foreach ($existingImagesData as $imageId => $imageIdentifier) {
            // Skip if marked for deletion
            if (in_array($imageId, $deleteImageIds)) {
                continue;
            }

            $image = SeoPageImage::find($imageId);
            if (!$image) {
                continue;
            }

            // Check if this image should be replaced with a new file
            $replacementFile = $replaceImagesData[$imageId] ?? null;
            if ($replacementFile && $replacementFile instanceof UploadedFile) {
                // Delete old file
                $this->deleteImage($image->image_path);
                // Store new file
                $newPath = $this->storeImage($replacementFile, 'seo_pages/blocks');
                $image->image_path = $newPath;
            }

            // Update alt text if provided
            $altText = $altTextsData[$imageId] ?? null;
            if ($altText !== null) {
                $image->alt_text = $altText;
            }

            $image->save();
            $remainingImageIds[] = $imageId;
        }

        // Delete images marked for removal
        foreach ($deleteImageIds as $imageId) {
            $image = SeoPageImage::find($imageId);
            if ($image) {
                $this->deleteImage($image->image_path);
                $image->delete();
            }
        }

        // Add new images
        $newImages = $blockData['images'] ?? [];
        if (!empty($newImages) && is_array($newImages)) {
            $currentMaxOrder = $block->images()->max('sort_order') ?? 0;
            $orderCounter = $currentMaxOrder + 1;

            foreach ($newImages as $newImage) {
                if ($newImage && $newImage instanceof UploadedFile && $newImage->isValid()) {
                    $path = $this->storeImage($newImage, 'seo_pages/blocks');
                    SeoPageImage::create([
                        'block_id'   => $block->id,
                        'image_path' => $path,
                        'alt_text'   => $altTextsData['new_' . $orderCounter] ?? null,
                        'sort_order' => $orderCounter++,
                    ]);
                }
            }
        }
    }

    private function syncBlockLinks(SeoPageBlock $block, array $blockData): void
    {
        // Delete all existing links for this block and recreate
        $block->links()->delete();

        $linkTexts = $blockData['link_texts'] ?? [];
        $linkUrls = $blockData['link_urls'] ?? [];

        foreach ($linkTexts as $i => $linkText) {
            $linkUrl = $linkUrls[$i] ?? null;
            if ($linkText && $linkUrl) {
                SeoPageLink::create([
                    'seo_page_id'       => $block->seo_page_id,
                    'block_id'          => $block->id,
                    'linked_page_title' => $linkText,
                    'linked_page_url'   => $linkUrl,
                ]);
            }
        }
    }

    private function storeImage(UploadedFile $file, string $folder): string
    {
        $destination = public_path('storage/' . $folder);

        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        $extension = $file->getClientOriginalExtension() ?: 'jpg';
        $filename  = Str::random(40) . '.' . $extension;

        $file->move($destination, $filename);

        return $folder . '/' . $filename;
    }

    private function deleteImage(string $relativePath): void
    {
        $fullPath = public_path('storage/' . $relativePath);

        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }
}