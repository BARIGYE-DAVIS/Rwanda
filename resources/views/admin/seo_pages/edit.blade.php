@extends('layouts.admin')

@section('title', 'Edit SEO Page')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6 pb-28">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit SEO Page</h1>
        <a href="{{ route('admin.seo-pages.index') }}"
           class="text-sm text-gray-500 hover:text-gray-800">
            &larr; Back to Pages
        </a>
    </div>

    {{-- Errors --}}
    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg p-4 mb-6">
            <ul class="list-disc list-inside text-sm space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.seo-pages.update', $seoPage) }}"
          method="POST"
          enctype="multipart/form-data"
          id="seo-page-form">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- LEFT: Page details + builder --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Page Details --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="px-5 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-700">Page Details</h2>
                    </div>
                    <div class="p-5 space-y-4">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   name="title"
                                   id="title-input"
                                   value="{{ old('title', $seoPage->title) }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                            <div class="flex rounded-lg border border-gray-300 overflow-hidden focus-within:ring-2 focus-within:ring-blue-500">
                                <span class="bg-gray-100 px-3 py-2 text-sm text-gray-500 border-r border-gray-300 whitespace-nowrap">
                                    /explore/
                                </span>
                                <input type="text"
                                       name="slug"
                                       id="slug-input"
                                       value="{{ old('slug', $seoPage->slug) }}"
                                       class="flex-1 px-3 py-2 text-sm focus:outline-none">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                            <textarea name="meta_description"
                                      rows="2"
                                      maxlength="320"
                                      class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('meta_description', $seoPage->meta_description) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Focus Keyword</label>
                            <input type="text"
                                   name="focus_keyword"
                                   value="{{ old('focus_keyword', $seoPage->focus_keyword) }}"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                    </div>
                </div>

                {{-- Content Builder --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="px-5 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-700">Page Content</h2>
                        <p class="text-xs text-gray-400 mt-0.5">
                            Click <strong>🔗 Add Link</strong> in the toolbar to insert inline links. Highlight text first to use it as link text.
                        </p>
                    </div>
                    <div class="p-5">
                        <div id="blocks-container">
                            @php $sortedBlocks = $seoPage->blocks->sortBy('sort_order')->values(); @endphp

                            @if($sortedBlocks->count() === 0)
                                <div id="blocks-empty-msg"
                                     class="text-center py-10 text-gray-400 border-2 border-dashed border-gray-200 rounded-lg">
                                    <p class="text-sm">Your page is empty.</p>
                                    <p class="text-xs mt-1">Use the toolbar at the bottom to add content blocks.</p>
                                </div>
                            @else
                                @foreach($sortedBlocks as $block)
                                    <div class="block-item border border-gray-200 rounded-xl p-4 mb-3 bg-gray-50"
                                         data-block-id="{{ $block->id }}"
                                         data-block-index="{{ $loop->index }}"
                                         data-index="{{ $loop->index }}">
                                        <input type="hidden" name="blocks[{{ $loop->index }}][id]" value="{{ $block->id }}">
                                        <input type="hidden" name="blocks[{{ $loop->index }}][type]" value="{{ $block->block_type }}">

                                        @if($block->block_type === 'heading')
                                            <div class="flex items-center justify-between mb-3">
                                                <span class="text-xs font-semibold uppercase tracking-wide text-gray-500">Heading</span>
                                                <button type="button" onclick="removeBlock(this)" class="text-xs text-red-500 hover:text-red-700">Remove</button>
                                            </div>
                                            <div class="flex gap-3 mb-3">
                                                <div class="w-36">
                                                    <label class="block text-xs text-gray-500 mb-1">Level</label>
                                                    <select name="blocks[{{ $loop->index }}][heading_level]" onchange="updateHeadingPreview(this)"
                                                            class="w-full border border-gray-300 rounded-lg px-2 py-1.5 text-sm">
                                                        @foreach(['h1','h2','h3','h4','h5','h6'] as $hl)
                                                            <option value="{{ $hl }}" {{ $block->heading_level === $hl ? 'selected' : '' }}>
                                                                {{ strtoupper($hl) }} — {{ $hl === 'h1' ? 'Page Title' : ($hl === 'h2' ? 'Section' : ($hl === 'h3' ? 'Sub-section' : '')) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="flex-1">
                                                    <label class="block text-xs text-gray-500 mb-1">Heading Text</label>
                                                    <input type="text" name="blocks[{{ $loop->index }}][content]"
                                                           class="heading-text w-full border border-gray-300 rounded-lg px-3 py-1.5 text-sm"
                                                           value="{{ $block->content }}"
                                                           oninput="updateHeadingPreview(this)">
                                                </div>
                                            </div>
                                            <div class="heading-preview px-3 py-2 bg-white rounded-lg border border-dashed border-gray-300 text-gray-400 text-sm italic">
                                                @php
                                                    $level = $block->heading_level ?? 'h2';
                                                    $text = $block->content ?: 'Preview appears here...';
                                                    $styles = [
                                                        'h1' => 'text-3xl font-bold text-gray-900',
                                                        'h2' => 'text-2xl font-bold text-gray-800',
                                                        'h3' => 'text-xl font-semibold text-gray-800',
                                                        'h4' => 'text-lg font-semibold text-gray-700',
                                                        'h5' => 'text-base font-semibold text-gray-700',
                                                        'h6' => 'text-sm font-semibold text-gray-600',
                                                    ];
                                                @endphp
                                                <{{ $level }} class="{{ $styles[$level] ?? $styles['h2'] }} not-italic">{{ $text }}</{{ $level }}>
                                            </div>

                                        @elseif($block->block_type === 'text')
                                            <div class="flex items-center justify-between mb-2">
                                                <span class="text-xs font-semibold uppercase tracking-wide text-gray-500">Paragraph</span>
                                                <div class="flex gap-2">
                                                    <button type="button" onclick="toggleMaximize(this)" title="Maximize editor"
                                                            class="text-xs px-2 py-1 rounded border border-gray-200 hover:bg-gray-100">⤢ Expand</button>
                                                    <button type="button" onclick="removeBlock(this)" class="text-xs text-red-500 hover:text-red-700">Remove</button>
                                                </div>
                                            </div>
                                            <div contenteditable="true"
                                                 data-block-type="text"
                                                 data-index="{{ $loop->index }}"
                                                 data-placeholder="Write your paragraph here..."
                                                 class="paragraph-editor w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500"
                                                 onfocus="setCurrentEditor(this)"
                                                 onclick="setCurrentEditor(this)"
                                                 onkeyup="saveSelection()"
                                                 onmouseup="saveSelection()"
                                                 oninput="syncParagraph(this, {{ $loop->index }})">{!! $block->content !!}</div>
                                            <input type="hidden" name="blocks[{{ $loop->index }}][content]" id="para-content-{{ $loop->index }}" value="{{ $block->content }}">

                                        @elseif($block->block_type === 'image')
                                            <div class="flex items-center justify-between mb-3">
                                                <span class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                                                    Images <span id="img-count-{{ $loop->index }}" class="text-blue-500"></span>
                                                </span>
                                                <button type="button" onclick="removeBlock(this)" class="text-xs text-red-500 hover:text-red-700">Remove</button>
                                            </div>

                                            {{-- Existing Images --}}
                                            @if($block->images->count() > 0)
                                                <div class="mb-3">
                                                    <label class="block text-xs text-gray-500 mb-2">Existing Images</label>
                                                    <div class="grid grid-cols-3 gap-2">
                                                        @foreach($block->images as $image)
                                                            <div class="relative rounded-lg overflow-hidden border border-gray-200 bg-white group existing-image-item"
                                                                 data-image-id="{{ $image->id }}">
                                                                <img src="{{ asset('storage/' . $image->image_path) }}"
                                                                     class="w-full object-cover" style="height: 90px;">
                                                                <input type="hidden" name="blocks[{{ $loop->parent->index }}][existing_images][{{ $image->id }}]" value="{{ $image->id }}">
                                                                <input type="hidden" name="blocks[{{ $loop->parent->index }}][delete_images][]" class="delete-image-flag" value="">
                                                                <button type="button"
                                                                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full w-5 h-5 text-xs flex items-center justify-center hover:bg-red-600"
                                                                        onclick="deleteExistingImage(this, {{ $loop->parent->index }}, {{ $image->id }})">&times;</button>
                                                                <input type="text"
                                                                       name="blocks[{{ $loop->parent->index }}][alts][{{ $image->id }}]"
                                                                       value="{{ $image->alt_text }}"
                                                                       placeholder="Alt text"
                                                                       class="w-full text-xs border-t border-gray-200 px-1 py-0.5 focus:outline-none">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif

                                            {{-- New Images Upload - Button BELOW previews --}}
                                            <div id="img-preview-{{ $loop->index }}" class="grid grid-cols-3 gap-2 mb-3"></div>
                                            <div id="img-transfer-{{ $loop->index }}"></div>
                                            <label class="block w-full border-2 border-dashed border-gray-300 rounded-xl p-5 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition">
                                                <input type="file" class="hidden" accept="image/jpeg,image/png,image/webp" multiple
                                                       onchange="accumulateImages(this, {{ $loop->index }})">
                                                <p class="text-gray-500 text-sm">Click to add images</p>
                                                <p class="text-gray-400 text-xs mt-1">Click multiple times to add more</p>
                                            </label>
                                            <div class="mt-3">
                                                <label class="block text-xs text-gray-500 mb-1">Alt Text (applies to all new images above)</label>
                                                <input type="text" name="blocks[{{ $loop->index }}][alts][]"
                                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm"
                                                       placeholder="Describe these images for SEO">
                                            </div>

                                            <script>if (!window.blockFiles) window.blockFiles = {}; window.blockFiles[{{ $loop->index }}] = window.blockFiles[{{ $loop->index }}] || [];</script>

                                        @elseif($block->block_type === 'links')
                                            <div class="flex items-center justify-between mb-3">
                                                <span class="text-xs font-semibold uppercase tracking-wide text-gray-500">Internal Links</span>
                                                <div class="flex gap-3">
                                                    <button type="button" onclick="openLinkModal({{ $loop->index }})" class="text-xs text-blue-600 hover:text-blue-800 font-medium">+ Add Link</button>
                                                    <button type="button" onclick="removeBlock(this)" class="text-xs text-red-500 hover:text-red-700">Remove</button>
                                                </div>
                                            </div>
                                            <div id="links-list-{{ $loop->index }}" class="space-y-2">
                                                @forelse($block->links as $link)
                                                    <div class="flex items-center justify-between bg-white border border-gray-200 rounded-lg px-3 py-2 text-sm">
                                                        <input type="hidden" name="blocks[{{ $loop->parent->index }}][link_texts][]" value="{{ $link->linked_page_title }}">
                                                        <input type="hidden" name="blocks[{{ $loop->parent->index }}][link_urls][]" value="{{ $link->linked_page_url }}">
                                                        <div class="min-w-0">
                                                            <p class="font-medium text-blue-600 truncate">{{ $link->linked_page_title }}</p>
                                                            <p class="text-xs text-gray-400 truncate">{{ $link->linked_page_url }}</p>
                                                        </div>
                                                        <button type="button" onclick="this.closest('div.flex').remove()"
                                                                class="ml-3 text-red-400 hover:text-red-600 text-xl leading-none">&times;</button>
                                                    </div>
                                                @empty
                                                    <p id="links-empty-{{ $loop->index }}" class="text-xs text-gray-400 italic">No links yet. Click + Add Link above.</p>
                                                @endforelse
                                            </div>
                                        @endif

                                        {{-- ── INSERT BLOCK BELOW THIS BLOCK ── --}}
                                        <div class="flex items-center gap-2 mt-3 pt-3 border-t border-gray-100">
                                            <span class="text-xs text-gray-400">Insert below:</span>
                                            <button type="button" onclick="insertBlockAfter('heading', this)" title="Heading"
                                                    class="text-xs px-2 py-1 rounded border border-gray-200 hover:bg-gray-100 font-bold">H</button>
                                            <button type="button" onclick="insertBlockAfter('text', this)" title="Paragraph"
                                                    class="text-xs px-2 py-1 rounded border border-gray-200 hover:bg-gray-100">¶</button>
                                            <button type="button" onclick="insertBlockAfter('image', this)" title="Images"
                                                    class="text-xs px-2 py-1 rounded border border-gray-200 hover:bg-gray-100">🖼️</button>
                                            
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            {{-- RIGHT: Publish + Featured Image --}}
            <div class="space-y-6">

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 sticky top-6">
                    <div class="px-5 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-700">Publishing</h2>
                    </div>
                    <div class="p-5 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                            <select name="status"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="draft" {{ old('status', $seoPage->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $seoPage->status) === 'published' ? 'selected' : '' }}>Published</option>
                                <option value="archived" {{ old('status', $seoPage->status) === 'archived' ? 'selected' : '' }}>Archived</option>
                            </select>
                        </div>
                        <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg text-sm transition">
                            Save Changes
                        </button>
                    </div>
                </div>

                {{-- Featured Image --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="px-5 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-700">Featured Image</h2>
                        <p class="text-xs text-gray-400 mt-0.5">Shown in previews and social sharing</p>
                    </div>
                    <div class="p-5">
                        @if($seoPage->featured_image)
                            <div id="featured-preview" class="mb-3">
                                <img id="featured-preview-img"
                                     src="{{ asset('storage/' . $seoPage->featured_image) }}"
                                     class="w-full rounded-lg object-cover border border-gray-200"
                                     style="max-height: 180px;">
                                <button type="button"
                                        onclick="removeFeaturedImage()"
                                        class="mt-2 text-xs text-red-500 hover:text-red-700">
                                    Remove image
                                </button>
                            </div>
                        @endif
                        <label id="featured-drop-zone"
                               class="block w-full border-2 border-dashed border-gray-300 rounded-xl p-6 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition">
                            <input type="file"
                                   name="featured_image"
                                   id="featured-image-input"
                                   class="hidden"
                                   accept="image/jpeg,image/png,image/webp"
                                   onchange="previewFeaturedImage(this)">
                            <div id="featured-upload-prompt" class="{{ $seoPage->featured_image ? 'hidden' : '' }}">
                                <p class="text-gray-500 text-sm">Click to upload</p>
                                <p class="text-gray-400 text-xs mt-1">JPG, PNG, WEBP</p>
                            </div>
                        </label>
                    </div>
                </div>

            </div>

        </div>
    </form>
</div>

{{-- ── FLOATING BOTTOM TOOLBAR WITH ADD LINK BUTTON ── --}}
<div class="fixed bottom-0 left-0 right-0 z-40 bg-white border-t border-gray-200 shadow-lg px-4 py-3">
    <div class="max-w-7xl mx-auto flex items-center justify-center gap-3">
        <span class="text-xs text-gray-400 mr-2 hidden sm:block">Add block:</span>
        <button type="button"
                onclick="addBlock('heading')"
                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg border border-gray-300 text-sm text-gray-700 hover:bg-gray-50 transition">
            <span class="font-bold">H</span> Heading
        </button>
        <button type="button"
                onclick="addBlock('text')"
                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg border border-gray-300 text-sm text-gray-700 hover:bg-gray-50 transition">
            ¶ Paragraph
        </button>
        <button type="button"
                onclick="addBlock('image')"
                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg border border-gray-300 text-sm text-gray-700 hover:bg-gray-50 transition">
            🖼️ Images
        </button>
        <button type="button"
                id="global-add-link-btn"
                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg border border-blue-300 bg-blue-50 text-sm text-blue-700 hover:bg-blue-100 transition font-medium">
            🔗 Add Link
        </button>
    </div>
</div>

{{-- ── INLINE LINK MODAL ── --}}
<div id="link-modal"
     class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Insert Link</h3>
        <div class="space-y-3">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Link Text</label>
                <input type="text"
                       id="modal-link-text"
                       placeholder="e.g. Click here to learn more"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">URL</label>
                <input type="url"
                       id="modal-link-url"
                       placeholder="https://..."
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <p id="modal-link-error" class="text-red-500 text-xs hidden">Please fill in both fields.</p>
        </div>
        <div class="flex gap-3 mt-5">
            <button type="button"
                    onclick="closeLinkModal()"
                    class="flex-1 border border-gray-300 text-gray-700 rounded-lg py-2 text-sm hover:bg-gray-50 transition">
                Cancel
            </button>
            <button type="button"
                    onclick="insertInlineLink()"
                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white rounded-lg py-2 text-sm font-medium transition">
                Insert Link
            </button>
        </div>
    </div>
</div>

{{-- ── LINK EDIT MODAL ── --}}
<div id="edit-link-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Edit Link</h3>
        <div class="space-y-3">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Link Text</label>
                <input type="text" id="edit-link-text" 
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">URL</label>
                <input type="url" id="edit-link-url" 
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
        </div>
        <div class="flex gap-3 mt-5">
            <button type="button" onclick="closeEditLinkModal()"
                    class="flex-1 border border-gray-300 text-gray-700 rounded-lg py-2 text-sm hover:bg-gray-50 transition">Cancel</button>
            <button type="button" onclick="saveEditedLink()"
                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white rounded-lg py-2 text-sm font-medium transition">Save</button>
            <button type="button" onclick="removeCurrentLink()"
                    class="flex-1 bg-red-600 hover:bg-red-700 text-white rounded-lg py-2 text-sm font-medium transition">Remove Link</button>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<style>
.paragraph-editor {
    white-space: pre-wrap;
    word-break: break-word;
    line-height: 1.7;
    min-height: 140px;
    max-height: 400px;
    overflow-y: auto;
    resize: vertical;
    outline: none;
}
.paragraph-editor:empty:before {
    content: attr(data-placeholder);
    color: #9ca3af;
    pointer-events: none;
    display: block;
}
.paragraph-editor a { 
    color: #2563eb; 
    text-decoration: underline;
    cursor: pointer;
}
.paragraph-editor a:hover {
    text-decoration: none;
}

/* ── MAXIMIZED PARAGRAPH EDITOR ── */
.paragraph-editor-maximized {
    position: fixed !important;
    top: 4% !important;
    left: 4% !important;
    right: 4% !important;
    bottom: 4% !important;
    width: 92% !important;
    height: 92% !important;
    max-height: none !important;
    z-index: 100;
    background: #fff;
    box-shadow: 0 10px 40px rgba(0,0,0,0.3);
    padding: 1.25rem !important;
    border-radius: 0.75rem;
    resize: none;
    font-size: 1rem;
}
#maximize-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.5);
    z-index: 90;
}
</style>

<script>
(function () {
    let blockIndex = {{ $seoPage->blocks->count() }};
    let activeLinkBlock = null;
    window.blockFiles = window.blockFiles || {};
    
    // Link editing variables
    let currentEditorForLink = null;
    let currentEditingLink = null;
    let currentEditingEditor = null;
    let savedSelectionRange = null;

    // ── INSERT-CONTROLS ROW ──
    function insertControlsHtml() {
        return `
            <div class="flex items-center gap-2 mt-3 pt-3 border-t border-gray-100">
                <span class="text-xs text-gray-400">Insert below:</span>
                <button type="button" onclick="insertBlockAfter('heading', this)" title="Heading"
                        class="text-xs px-2 py-1 rounded border border-gray-200 hover:bg-gray-100 font-bold">H</button>
                <button type="button" onclick="insertBlockAfter('text', this)" title="Paragraph"
                        class="text-xs px-2 py-1 rounded border border-gray-200 hover:bg-gray-100">¶</button>
                <button type="button" onclick="insertBlockAfter('image', this)" title="Images"
                        class="text-xs px-2 py-1 rounded border border-gray-200 hover:bg-gray-100">🖼️</button>
            </div>`;
    }

    // Save selected text for link
    window.saveSelection = function() {
        const sel = window.getSelection();
        if (sel && !sel.isCollapsed && sel.toString().trim()) {
            savedSelectionRange = sel.getRangeAt(0).cloneRange();
            const editor = sel.anchorNode?.nodeType === 3 ? sel.anchorNode.parentElement?.closest('[data-block-type="text"]') : sel.anchorNode?.closest('[data-block-type="text"]');
            if (editor) currentEditorForLink = editor;
        } else {
            savedSelectionRange = null;
        }
    };

    window.setCurrentEditor = function(el) {
        currentEditorForLink = el;
    };

    window.syncParagraph = function (el, idx) {
        const h = document.getElementById('para-content-' + idx);
        if (h) h.value = el.innerHTML;
    };

    // ── MAXIMIZE / RESTORE PARAGRAPH EDITOR ──
    window.toggleMaximize = function (btn) {
        const blockItem = btn.closest('.block-item');
        const editor = blockItem.querySelector('.paragraph-editor');
        if (!editor) return;

        if (editor.classList.contains('paragraph-editor-maximized')) {
            restoreEditor(editor, btn);
        } else {
            maximizeEditor(editor, btn);
        }
    };

    function maximizeEditor(editor, btn) {
        editor.classList.add('paragraph-editor-maximized');
        document.body.classList.add('overflow-hidden');

        const backdrop = document.createElement('div');
        backdrop.id = 'maximize-backdrop';
        backdrop.addEventListener('click', () => restoreEditor(editor, btn));
        document.body.appendChild(backdrop);

        btn.innerHTML = '🗗 Collapse';
        btn.title = 'Restore editor size';

        // ESC key closes maximized editor
        document.addEventListener('keydown', escCloseHandler);
        editor._escHandler = escCloseHandler;

        function escCloseHandler(e) {
            if (e.key === 'Escape') restoreEditor(editor, btn);
        }

        editor.focus();
    }

    function restoreEditor(editor, btn) {
        editor.classList.remove('paragraph-editor-maximized');
        document.body.classList.remove('overflow-hidden');

        const backdrop = document.getElementById('maximize-backdrop');
        if (backdrop) backdrop.remove();

        if (editor._escHandler) {
            document.removeEventListener('keydown', editor._escHandler);
            delete editor._escHandler;
        }

        btn.innerHTML = '⤢ Expand';
        btn.title = 'Maximize editor';
    }

    // ── BUILD NEW BLOCK ──
    function buildBlock(type, idx) {
        const div = document.createElement('div');
        div.className = 'block-item border border-gray-200 rounded-xl p-4 mb-3 bg-gray-50';
        div.dataset.index = idx;

        let inner = `<input type="hidden" name="blocks[${idx}][type]" value="${type}">`;

        if (type === 'heading') {
            inner += `
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-semibold uppercase tracking-wide text-gray-500">Heading</span>
                <button type="button" onclick="removeBlock(this)" class="text-xs text-red-500 hover:text-red-700">Remove</button>
            </div>
            <div class="flex gap-3 mb-3">
                <div class="w-36">
                    <label class="block text-xs text-gray-500 mb-1">Level</label>
                    <select name="blocks[${idx}][heading_level]" onchange="updateHeadingPreview(this)"
                            class="w-full border border-gray-300 rounded-lg px-2 py-1.5 text-sm">
                        <option value="h1">H1 — Page Title</option>
                        <option value="h2" selected>H2 — Section</option>
                        <option value="h3">H3 — Sub-section</option>
                        <option value="h4">H4</option>
                        <option value="h5">H5</option>
                        <option value="h6">H6</option>
                    </select>
                </div>
                <div class="flex-1">
                    <label class="block text-xs text-gray-500 mb-1">Heading Text</label>
                    <input type="text" name="blocks[${idx}][content]"
                           class="heading-text w-full border border-gray-300 rounded-lg px-3 py-1.5 text-sm"
                           placeholder="Enter heading text" oninput="updateHeadingPreview(this)">
                </div>
            </div>
            <div class="heading-preview px-3 py-2 bg-white rounded-lg border border-dashed border-gray-300 text-gray-400 text-sm italic">
                Preview appears here...
            </div>`;
        }

        if (type === 'text') {
            inner += `
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs font-semibold uppercase tracking-wide text-gray-500">Paragraph</span>
                <div class="flex gap-2">
                    <button type="button" onclick="toggleMaximize(this)" title="Maximize editor"
                            class="text-xs px-2 py-1 rounded border border-gray-200 hover:bg-gray-100">⤢ Expand</button>
                    <button type="button" onclick="removeBlock(this)" class="text-xs text-red-500 hover:text-red-700">Remove</button>
                </div>
            </div>
            <div contenteditable="true"
                 data-block-type="text"
                 data-index="${idx}"
                 data-placeholder="Write your paragraph here..."
                 class="paragraph-editor w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500"
                 onfocus="setCurrentEditor(this)"
                 onclick="setCurrentEditor(this)"
                 onkeyup="saveSelection()"
                 onmouseup="saveSelection()"
                 oninput="syncParagraph(this, ${idx})"></div>
            <input type="hidden" name="blocks[${idx}][content]" id="para-content-${idx}">`;
        }

        if (type === 'image') {
            window.blockFiles[idx] = [];
            inner += `
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                    Images <span id="img-count-${idx}" class="text-blue-500"></span>
                </span>
                <button type="button" onclick="removeBlock(this)" class="text-xs text-red-500 hover:text-red-700">Remove</button>
            </div>
            <div id="img-preview-${idx}" class="grid grid-cols-3 gap-2 mb-3"></div>
            <div id="img-transfer-${idx}"></div>
            <label class="block w-full border-2 border-dashed border-gray-300 rounded-xl p-5 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition">
                <input type="file" class="hidden" accept="image/jpeg,image/png,image/webp" multiple
                       onchange="accumulateImages(this, ${idx})">
                <p class="text-gray-500 text-sm">Click to add images</p>
                <p class="text-gray-400 text-xs mt-1">Click multiple times to add more</p>
            </label>
            <div class="mt-3">
                <label class="block text-xs text-gray-500 mb-1">Alt Text</label>
                <input type="text" name="blocks[${idx}][alts][]"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm"
                       placeholder="Describe these images for SEO">
            </div>`;
        }

        inner += insertControlsHtml();
        div.innerHTML = inner;
        return div;
    }

    // ── ADD / INSERT / REMOVE BLOCKS ──
    window.addBlock = function (type) {
        const emptyMsg = document.getElementById('blocks-empty-msg');
        if (emptyMsg) emptyMsg.remove();

        const container = document.getElementById('blocks-container');
        const div = buildBlock(type, blockIndex);
        container.appendChild(div);
        
        if (type === 'text') {
            const editor = div.querySelector('.paragraph-editor');
            if (editor) {
                editor.focus();
                currentEditorForLink = editor;
            }
        }
        
        blockIndex++;
    };

    window.insertBlockAfter = function (type, btn) {
        const emptyMsg = document.getElementById('blocks-empty-msg');
        if (emptyMsg) emptyMsg.remove();

        const refBlock = btn.closest('.block-item');
        const div = buildBlock(type, blockIndex);

        if (refBlock && refBlock.parentElement) {
            refBlock.insertAdjacentElement('afterend', div);
        } else {
            document.getElementById('blocks-container').appendChild(div);
        }

        if (type === 'text') {
            const editor = div.querySelector('.paragraph-editor');
            if (editor) editor.focus();
        }

        blockIndex++;
    };

    window.removeBlock = function (btn) {
        if (!confirm('Remove this block?')) return;
        const block = btn.closest('.block-item');
        const idx = block.dataset.index;
        delete window.blockFiles[idx];
        block.remove();

        if (document.querySelectorAll('.block-item').length === 0) {
            document.getElementById('blocks-container').innerHTML = `
                <div id="blocks-empty-msg" class="text-center py-10 text-gray-400 border-2 border-dashed border-gray-200 rounded-lg">
                    <p class="text-sm">Your page is empty.</p>
                    <p class="text-xs mt-1">Use the toolbar at the bottom to add content blocks.</p>
                </div>`;
        }
    };

    // ── HEADING PREVIEW ──
    window.updateHeadingPreview = function (el) {
        const block = el.closest('.block-item');
        const level = block.querySelector('select').value;
        const text = block.querySelector('.heading-text').value || 'Preview appears here...';
        const preview = block.querySelector('.heading-preview');

        const styles = {
            h1: 'text-3xl font-bold text-gray-900',
            h2: 'text-2xl font-bold text-gray-800',
            h3: 'text-xl font-semibold text-gray-800',
            h4: 'text-lg font-semibold text-gray-700',
            h5: 'text-base font-semibold text-gray-700',
            h6: 'text-sm font-semibold text-gray-600',
        };

        preview.innerHTML = `<${level} class="${styles[level]} not-italic">${escapeHtml(text)}</${level}>`;
    };

    // ── IMAGE FUNCTIONS ──
    window.accumulateImages = function (input, idx) {
        if (!window.blockFiles[idx]) window.blockFiles[idx] = [];

        Array.from(input.files).forEach(file => {
            const exists = window.blockFiles[idx].some(f => f.name === file.name && f.size === file.size);
            if (!exists) window.blockFiles[idx].push(file);
        });

        input.value = '';
        renderImagePreviews(idx);
    };

    function renderImagePreviews(idx) {
        const grid = document.getElementById(`img-preview-${idx}`);
        const count = document.getElementById(`img-count-${idx}`);
        const files = window.blockFiles[idx] || [];

        if (count) count.textContent = files.length > 0 ? `(${files.length})` : '';
        if (!grid) return;
        grid.innerHTML = '';

        files.forEach((file, i) => {
            const wrapper = document.createElement('div');
            wrapper.className = 'relative rounded-lg overflow-hidden border border-gray-200 bg-white group';

            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.className = 'w-full object-cover';
            img.style = 'height: 90px;';

            const removeBtn = document.createElement('button');
            removeBtn.type = 'button';
            removeBtn.className = 'absolute top-1 right-1 bg-red-500 text-white rounded-full w-5 h-5 text-xs flex items-center justify-center opacity-0 group-hover:opacity-100 transition';
            removeBtn.innerHTML = '&times;';
            removeBtn.onclick = () => {
                window.blockFiles[idx].splice(i, 1);
                renderImagePreviews(idx);
            };

            wrapper.appendChild(img);
            wrapper.appendChild(removeBtn);
            grid.appendChild(wrapper);
        });

        syncFilesToInput(idx);
    }

    function syncFilesToInput(idx) {
        const transfer = document.getElementById(`img-transfer-${idx}`);
        if (!transfer) return;
        transfer.innerHTML = '';

        const dt = new DataTransfer();
        (window.blockFiles[idx] || []).forEach(f => dt.items.add(f));

        const realInput = document.createElement('input');
        realInput.type = 'file';
        realInput.name = `blocks[${idx}][images][]`;
        realInput.multiple = true;
        realInput.className = 'hidden';
        realInput.files = dt.files;

        transfer.appendChild(realInput);
    }

    // ── DELETE EXISTING IMAGE ──
    window.deleteExistingImage = function (btn, blockIdx, imageId) {
        if (!confirm('Delete this image?')) return;
        const item = btn.closest('.existing-image-item');
        const flag = item.querySelector('.delete-image-flag');
        if (flag) flag.value = imageId;
        item.style.opacity = '0.3';
        item.style.pointerEvents = 'none';
    };

    // ── FEATURED IMAGE ──
    window.previewFeaturedImage = function (input) {
        if (!input.files || !input.files[0]) return;

        let preview = document.getElementById('featured-preview');
        const previewImg = document.getElementById('featured-preview-img');
        const prompt = document.getElementById('featured-upload-prompt');

        if (!preview) {
            const dropZone = document.getElementById('featured-drop-zone');
            preview = document.createElement('div');
            preview.id = 'featured-preview';
            preview.className = 'mb-3';
            preview.innerHTML = `
                <img id="featured-preview-img" class="w-full rounded-lg object-cover border border-gray-200" style="max-height: 180px;">
                <button type="button" onclick="removeFeaturedImage()" class="mt-2 text-xs text-red-500 hover:text-red-700">Remove image</button>
            `;
            dropZone.parentNode.insertBefore(preview, dropZone);
        }

        previewImg.src = URL.createObjectURL(input.files[0]);
        preview.classList.remove('hidden');
        if (prompt) prompt.classList.add('hidden');
    };

    window.removeFeaturedImage = function () {
        document.getElementById('featured-image-input').value = '';
        const preview = document.getElementById('featured-preview');
        const prompt = document.getElementById('featured-upload-prompt');
        if (preview) preview.classList.add('hidden');
        if (prompt) prompt.classList.remove('hidden');
    };

    // ── INLINE LINK FUNCTIONS (WORDPRESS STYLE) ──
    function openLinkModal() {
        if (!currentEditorForLink) {
            alert('Please click inside a paragraph first, then click Add Link.');
            return;
        }
        
        currentEditorForLink.focus();
        
        const sel = window.getSelection();
        const selectedText = sel && !sel.isCollapsed ? sel.toString().trim() : '';
        
        document.getElementById('modal-link-text').value = selectedText || '';
        document.getElementById('modal-link-url').value = '';
        document.getElementById('modal-link-error').classList.add('hidden');
        
        const modal = document.getElementById('link-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        if (!selectedText) {
            document.getElementById('modal-link-text').focus();
        } else {
            document.getElementById('modal-link-url').focus();
        }
    }
    
    window.closeLinkModal = function () {
        const modal = document.getElementById('link-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        savedSelectionRange = null;
    };
    
    window.insertInlineLink = function () {
        const linkText = document.getElementById('modal-link-text').value.trim();
        const linkUrl = document.getElementById('modal-link-url').value.trim();
        
        if (!linkText || !linkUrl) {
            document.getElementById('modal-link-error').classList.remove('hidden');
            return;
        }
        
        if (!currentEditorForLink) {
            closeLinkModal();
            return;
        }
        
        currentEditorForLink.focus();
        
        if (savedSelectionRange) {
            const sel = window.getSelection();
            sel.removeAllRanges();
            sel.addRange(savedSelectionRange);
        }
        
        const linkHtml = `<a href="${escapeHtml(linkUrl)}" target="_blank" rel="noopener noreferrer">${escapeHtml(linkText)}</a>`;
        document.execCommand('insertHTML', false, linkHtml);
        
        const idx = currentEditorForLink.dataset.index;
        const hiddenInput = document.getElementById('para-content-' + idx);
        if (hiddenInput) {
            hiddenInput.value = currentEditorForLink.innerHTML;
        }
        
        savedSelectionRange = null;
        closeLinkModal();
    };
    
    // ── DOUBLE CLICK TO EDIT LINKS ──
    window.closeEditLinkModal = function () {
        const m = document.getElementById('edit-link-modal');
        m.classList.add('hidden');
        m.classList.remove('flex');
        currentEditingLink = null;
        currentEditingEditor = null;
    };
    
    window.saveEditedLink = function () {
        if (!currentEditingLink || !currentEditingEditor) return;
        
        const newText = document.getElementById('edit-link-text').value.trim();
        const newUrl = document.getElementById('edit-link-url').value.trim();
        
        if (!newText || !newUrl) return;
        
        const newLink = document.createElement('a');
        newLink.href = newUrl;
        newLink.target = '_blank';
        newLink.rel = 'noopener noreferrer';
        newLink.textContent = newText;
        
        currentEditingLink.parentNode.replaceChild(newLink, currentEditingLink);
        
        const hiddenInput = document.getElementById('para-content-' + currentEditingEditor.dataset.index);
        if (hiddenInput) {
            hiddenInput.value = currentEditingEditor.innerHTML;
        }
        
        closeEditLinkModal();
    };
    
    window.removeCurrentLink = function () {
        if (!currentEditingLink || !currentEditingEditor) return;
        
        const text = document.createTextNode(currentEditingLink.textContent);
        currentEditingLink.parentNode.replaceChild(text, currentEditingLink);
        
        const hiddenInput = document.getElementById('para-content-' + currentEditingEditor.dataset.index);
        if (hiddenInput) {
            hiddenInput.value = currentEditingEditor.innerHTML;
        }
        
        closeEditLinkModal();
    };
    
    document.addEventListener('dblclick', function(e) {
        const link = e.target.closest('a');
        if (link && link.closest('[data-block-type="text"]')) {
            e.preventDefault();
            e.stopPropagation();
            
            currentEditingLink = link;
            currentEditingEditor = link.closest('[data-block-type="text"]');
            
            document.getElementById('edit-link-text').value = link.textContent;
            document.getElementById('edit-link-url').value = link.href;
            
            const m = document.getElementById('edit-link-modal');
            m.classList.remove('hidden');
            m.classList.add('flex');
        }
    });
    
    // ── LINK MODAL CLOSE ON OUTSIDE CLICK ──
    document.getElementById('link-modal')?.addEventListener('click', function (e) {
        if (e.target === this) closeLinkModal();
    });
    document.getElementById('edit-link-modal')?.addEventListener('click', function (e) {
        if (e.target === this) closeEditLinkModal();
    });
    
    // ── ADD LINK BUTTON HANDLER ──
    document.getElementById('global-add-link-btn').addEventListener('click', openLinkModal);
    
    // ── SLUG AUTO-GENERATE ──...
    const titleInput = document.getElementById('title-input');
    const slugInput = document.getElementById('slug-input');

    if (titleInput && slugInput) {
        titleInput.addEventListener('input', function () {
            if (slugInput.dataset.manual !== 'true') {
                slugInput.value = this.value
                    .toLowerCase().trim()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-');
            }
        });

        slugInput.addEventListener('input', function () {
            this.dataset.manual = 'true';
        });
    }
    
    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/[&<>]/g, function(m) {
            if (m === '&') return '&amp;';
            if (m === '<') return '&lt;';
            if (m === '>') return '&gt;';
            return m;
        });
    }
    
    // Initialize existing paragraph editors for link functionality
    document.querySelectorAll('.paragraph-editor').forEach(editor => {
        editor.addEventListener('keyup', saveSelection);
        editor.addEventListener('mouseup', saveSelection);
        editor.addEventListener('click', () => setCurrentEditor(editor));
        editor.addEventListener('focus', () => setCurrentEditor(editor));
    });
    
})();
</script>
@endpush