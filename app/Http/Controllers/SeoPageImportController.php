<?php

namespace App\Http\Controllers;

use App\Models\SeoPage;
use App\Models\SeoPageBlock;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpOffice\PhpWord\IOFactory;

class SeoPageImportController extends Controller
{
    public function showImportForm()
    {
        return view('admin.seo_pages.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:docx,txt|max:5120'
        ]);

        $content = $this->extractContent($request->file('file'));
        $this->createSeoPageFromContent($content);

        return redirect()->route('admin.seo-pages.index')
            ->with('success', 'SEO Page imported successfully!');
    }

    private function extractContent($file)
    {
        $extension = $file->getClientOriginalExtension();

        if ($extension === 'txt') {
            return file_get_contents($file->getRealPath());
        }

        // For DOCX
        $phpWord = IOFactory::load($file->getRealPath());
        $content = '';
        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                if (method_exists($element, 'getText')) {
                    $content .= $element->getText() . "\n";
                }
            }
        }
        return $content;
    }

    private function createSeoPageFromContent($content)
    {
        $lines = explode("\n", $content);
        $blocks = [];
        $currentBlock = null;
        $title = '';
        $metaDescription = '';
        $focusKeyword = '';

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;

            // Check for SEO Title
            if (strpos($line, 'SEO Title:') === 0) {
                $title = trim(str_replace('SEO Title:', '', $line));
                continue;
            }

            // Check for Meta Description
            if (strpos($line, 'Meta Description:') === 0) {
                $metaDescription = trim(str_replace('Meta Description:', '', $line));
                continue;
            }

            // Check for Focus Keyword
            if (strpos($line, 'Focus Keyword:') === 0) {
                $focusKeyword = trim(str_replace('Focus Keyword:', '', $line));
                if (empty($title)) {
                    $title = $focusKeyword;
                }
                continue;
            }

            // Check if line is bold/heading (starts with **)
            if (strpos($line, '**') !== false) {
                $headingText = trim(str_replace('**', '', $line));
                if (!empty($headingText)) {
                    $blocks[] = [
                        'type' => 'heading',
                        'level' => 'h2',
                        'content' => $headingText
                    ];
                }
                continue;
            }

            // Check if line is a list item (starts with - or • or number)
            if (preg_match('/^[\s]*[-•*]\s/', $line) || preg_match('/^\d+\.\s/', $line)) {
                $listItem = preg_replace('/^[\s]*[-•*]\s/', '', $line);
                $listItem = preg_replace('/^\d+\.\s/', '', $listItem);
                
                if (!isset($currentBlock) || $currentBlock['type'] !== 'list') {
                    $currentBlock = [
                        'type' => 'list',
                        'list_type' => 'ul',
                        'items' => []
                    ];
                }
                $currentBlock['items'][] = $listItem;
                continue;
            }

            // Regular paragraph
            if (!empty($line) && 
                strpos($line, 'SEO Title:') === false && 
                strpos($line, 'Meta Description:') === false && 
                strpos($line, 'Focus Keyword:') === false) {
                
                if ($currentBlock && $currentBlock['type'] === 'list') {
                    $blocks[] = $currentBlock;
                    $currentBlock = null;
                }
                $blocks[] = [
                    'type' => 'text',
                    'content' => $line
                ];
            }
        }

        // Save the last list if any
        if ($currentBlock && $currentBlock['type'] === 'list') {
            $blocks[] = $currentBlock;
        }

        // Create the SEO Page
        $page = SeoPage::create([
            'title' => $title ?: 'Imported Page',
            'slug' => Str::slug($title ?: 'imported-page'),
            'meta_description' => $metaDescription,
            'focus_keyword' => $focusKeyword,
            'status' => 'draft'
        ]);

        // Save blocks
        foreach ($blocks as $index => $blockData) {
            if ($blockData['type'] === 'heading') {
                SeoPageBlock::create([
                    'seo_page_id' => $page->id,
                    'block_type' => 'heading',
                    'heading_level' => $blockData['level'] ?? 'h2',
                    'content' => $blockData['content'],
                    'sort_order' => $index
                ]);
            } elseif ($blockData['type'] === 'list') {
                $listContent = '';
                foreach ($blockData['items'] as $item) {
                    $listContent .= '• ' . $item . "\n";
                }
                SeoPageBlock::create([
                    'seo_page_id' => $page->id,
                    'block_type' => 'list',
                    'list_type' => $blockData['list_type'] ?? 'ul',
                    'content' => $listContent,
                    'sort_order' => $index
                ]);
            } else {
                SeoPageBlock::create([
                    'seo_page_id' => $page->id,
                    'block_type' => 'text',
                    'content' => $blockData['content'],
                    'sort_order' => $index
                ]);
            }
        }

        return $page;
    }
}