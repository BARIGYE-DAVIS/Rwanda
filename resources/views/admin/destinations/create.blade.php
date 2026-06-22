@extends('layouts.admin')

@section('title', 'Create Destination')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6 pb-28">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Create Destination</h1>
        <a href="{{ route('admin.destinations.index') }}"
           class="text-sm text-gray-500 hover:text-gray-800">
            &larr; Back to Destinations
        </a>
    </div>

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-lg p-4 mb-6">
            <ul class="list-disc list-inside text-sm space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.destinations.store') }}"
          method="POST"
          enctype="multipart/form-data"
          id="destination-form">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- MAIN CONTENT COLUMN --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Basic Info --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="px-5 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-700">Basic Information</h2>
                    </div>
                    <div class="p-5 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Country <span class="text-red-500">*</span>
                            </label>
                            <select name="country_id" id="country_id" required
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}" {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                        {!! $country->flag_icon ?? '' !!} {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Destination Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" id="name-input"
                                   value="{{ old('name') }}"
                                   placeholder="e.g., Murchison Falls National Park"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Slug</label>
                            <div class="flex rounded-lg border border-gray-300 overflow-hidden focus-within:ring-2 focus:ring-blue-500">
                                <span class="bg-gray-100 px-3 py-2 text-sm text-gray-500 border-r border-gray-300 whitespace-nowrap">/destinations/</span>
                                <input type="text" name="slug" id="slug-input"
                                       value="{{ old('slug') }}"
                                       placeholder="auto-generated from name"
                                       class="flex-1 px-3 py-2 text-sm focus:outline-none">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Destination Type</label>
                            <select name="type" id="type"
                                    class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Select Type</option>
                                @foreach(['National Park','Wildlife Reserve','Forest Reserve','Game Reserve','Conservation Area','Wildlife Sanctuary','City','Lake','Mountain','Island'] as $t)
                                    <option value="{{ $t }}" {{ old('type') == $t ? 'selected' : '' }}>{{ $t }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- SEO Fields --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="px-5 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-700">SEO Information</h2>
                    </div>
                    <div class="p-5 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">SEO Title</label>
                            <input type="text" name="meta_title"
                                   value="{{ old('meta_title') }}"
                                   placeholder="e.g., Murchison Falls National Park - Uganda Safari Guide"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Meta Description</label>
                            <textarea name="meta_description" rows="2" maxlength="320"
                                      placeholder="160–320 characters shown in Google search results"
                                      class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('meta_description') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Focus Keyword</label>
                            <input type="text" name="focus_keyword"
                                   value="{{ old('focus_keyword') }}"
                                   placeholder="e.g., Murchison Falls National Park"
                                   class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </div>
                </div>

                {{-- Content Builder --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="px-5 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-700">Page Content</h2>
                        <p class="text-xs text-gray-400 mt-0.5">
                            Click <strong>🔗 Add Link</strong> to insert an inline link. Double-click any link to edit it.
                            Use <strong>"Insert below"</strong> buttons to add content between existing blocks.
                        </p>
                    </div>
                    <div class="p-5">
                        <div id="blocks-container">
                            <div id="blocks-empty-msg"
                                 class="text-center py-10 text-gray-400 border-2 border-dashed border-gray-200 rounded-lg">
                                <p class="text-sm">Your page is empty.</p>
                                <p class="text-xs mt-1">Use the toolbar at the bottom to add content blocks.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- RIGHT SIDEBAR --}}
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
                                <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                            </select>
                        </div>
                        <button type="submit"
                                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 rounded-lg text-sm transition">
                            Create Destination
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
                        <label id="featured-drop-zone"
                               class="block w-full border-2 border-dashed border-gray-300 rounded-xl p-6 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition">
                            <input type="file" name="featured_image" id="featured-image-input"
                                   class="hidden" accept="image/jpeg,image/png,image/webp"
                                   onchange="previewFeaturedImage(this)">
                            <div id="featured-upload-prompt">
                                <p class="text-gray-500 text-sm">Click to upload</p>
                                <p class="text-gray-400 text-xs mt-1">JPG, PNG, WEBP</p>
                            </div>
                        </label>
                        <div id="featured-preview" class="mt-3 hidden">
                            <img id="featured-preview-img" src="" alt=""
                                 class="w-full rounded-lg object-cover border border-gray-200"
                                 style="max-height:180px;">
                            <button type="button" onclick="removeFeaturedImage()"
                                    class="mt-2 text-xs text-red-500 hover:text-red-700">Remove image</button>
                        </div>
                    </div>
                </div>

                {{-- Main Image --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="px-5 py-4 border-b border-gray-100">
                        <h2 class="font-semibold text-gray-700">Main Image</h2>
                        <p class="text-xs text-gray-400 mt-0.5">Used in listings</p>
                    </div>
                    <div class="p-5">
                        <label id="main-drop-zone"
                               class="block w-full border-2 border-dashed border-gray-300 rounded-xl p-6 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition">
                            <input type="file" name="image" id="main-image-input"
                                   class="hidden" accept="image/jpeg,image/png,image/webp"
                                   onchange="previewMainImage(this)">
                            <div id="main-upload-prompt">
                                <p class="text-gray-500 text-sm">Click to upload</p>
                                <p class="text-gray-400 text-xs mt-1">JPG, PNG, WEBP</p>
                            </div>
                        </label>
                        <div id="main-preview" class="mt-3 hidden">
                            <img id="main-preview-img" src="" alt=""
                                 class="w-full rounded-lg object-cover border border-gray-200"
                                 style="max-height:180px;">
                            <button type="button" onclick="removeMainImage()"
                                    class="mt-2 text-xs text-red-500 hover:text-red-700">Remove image</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

{{-- FLOATING TOOLBAR --}}
<div class="fixed bottom-0 left-0 right-0 z-40 bg-white border-t border-gray-200 shadow-lg px-4 py-3">
    <div class="max-w-7xl mx-auto flex items-center justify-center gap-2 flex-wrap">
        <span class="text-xs text-gray-400 mr-2 hidden sm:block">Add block:</span>
        <button type="button" onclick="addBlock('heading')"
                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg border border-gray-300 text-sm text-gray-700 hover:bg-gray-50 transition">
            <span class="font-bold">H</span> Heading
        </button>
        <button type="button" onclick="addBlock('text')"
                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg border border-gray-300 text-sm text-gray-700 hover:bg-gray-50 transition">
            ¶ Paragraph
        </button>
        <button type="button" onclick="addBlock('image')"
                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg border border-gray-300 text-sm text-gray-700 hover:bg-gray-50 transition">
            🖼️ Images
        </button>
        <button type="button" onclick="addBlock('list')"
                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg border border-gray-300 text-sm text-gray-700 hover:bg-gray-50 transition">
            📋 List
        </button>
        <button type="button" id="global-add-link-btn"
                class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg border border-blue-300 bg-blue-50 text-sm text-blue-700 hover:bg-blue-100 transition font-medium">
            🔗 Add Link
        </button>
    </div>
</div>

{{-- INLINE LINK MODAL --}}
<div id="link-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md mx-4 p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Insert Link</h3>
        <div class="space-y-3">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Link Text</label>
                <input type="text" id="modal-link-text"
                       placeholder="e.g. Click here to learn more"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">URL</label>
                <input type="url" id="modal-link-url"
                       placeholder="https://..."
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <p id="modal-link-error" class="text-red-500 text-xs hidden">Please fill in both fields.</p>
        </div>
        <div class="flex gap-3 mt-5">
            <button type="button" onclick="closeLinkModal()"
                    class="flex-1 border border-gray-300 text-gray-700 rounded-lg py-2 text-sm hover:bg-gray-50 transition">Cancel</button>
            <button type="button" onclick="insertInlineLink()"
                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white rounded-lg py-2 text-sm font-medium transition">Insert Link</button>
        </div>
    </div>
</div>

{{-- LINK EDIT MODAL --}}
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

@push('scripts')
<style>
.paragraph-editor {
    white-space: pre-wrap;
    word-break: break-word;
    line-height: 1.7;
    min-height: 140px;
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
.paragraph-editor ul,
.paragraph-editor ol {
    padding-left: 2rem;
    margin: 0.5rem 0;
}
.paragraph-editor li {
    margin-bottom: 0.25rem;
}
.paragraph-editor li a {
    color: #2563eb;
    text-decoration: underline;
}
.heading-preview {
    min-height: 40px;
}
</style>

<script>
(function () {
    let blockIndex = 0;

    // ✅ FIX: blockFiles stores File objects per block index.
    // We no longer use DataTransfer to assign to hidden inputs at submit time.
    // Instead each image block gets a REAL <input type="file"> in the DOM
    // that the browser's native form serializer will submit correctly.
    const blockFiles = {};

    let currentEditorForLink = null;
    let currentEditingLink   = null;
    let currentEditingEditor = null;
    let savedSelectionRange  = null;

    // ── BUILD BLOCK ─────────────────────────────────────────
    function buildBlock(type, idx) {
        const div = document.createElement('div');
        div.className   = 'block-item border border-gray-200 rounded-xl p-4 mb-3 bg-gray-50';
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
                <button type="button" onclick="removeBlock(this)" class="text-xs text-red-500 hover:text-red-700">Remove</button>
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
                 oninput="syncContent(this,${idx})"></div>
            <input type="hidden" name="blocks[${idx}][content]" id="content-${idx}">`;
        }

        if (type === 'image') {
            blockFiles[idx] = [];
            // ✅ FIX: img-file-input-${idx} is a REAL persistent input in the DOM.
            // We rebuild its FileList via DataTransfer every time files change,
            // but the input itself always lives in the DOM so the browser submits it.
            inner += `
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-semibold uppercase tracking-wide text-gray-500">
                    Images <span id="img-count-${idx}" class="text-blue-500"></span>
                </span>
                <button type="button" onclick="removeBlock(this)" class="text-xs text-red-500 hover:text-red-700">Remove</button>
            </div>
            <div id="img-grid-${idx}" class="grid grid-cols-3 gap-3 mb-3"></div>

            {{-- ✅ This is the REAL file input that gets submitted with the form --}}
            <input type="file"
                   id="img-file-input-${idx}"
                   name="blocks[${idx}][images][]"
                   multiple
                   accept="image/jpeg,image/png,image/webp"
                   style="display:none">

            <label class="block w-full border-2 border-dashed border-gray-300 rounded-xl p-5 text-center cursor-pointer hover:border-blue-400 hover:bg-blue-50 transition">
                <input type="file" class="hidden" accept="image/jpeg,image/png,image/webp" multiple
                       onchange="accumulateImages(this,${idx})">
                <p class="text-gray-500 text-sm">Click to add images</p>
                <p class="text-gray-400 text-xs mt-1">Click multiple times to add more</p>
            </label>`;
        }

        if (type === 'list') {
            inner += `
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-semibold uppercase tracking-wide text-gray-500">📋 List</span>
                <button type="button" onclick="removeBlock(this)" class="text-xs text-red-500 hover:text-red-700">Remove</button>
            </div>
            <div class="flex gap-3 mb-3">
                <div class="w-36">
                    <label class="block text-xs text-gray-500 mb-1">Type</label>
                    <select name="blocks[${idx}][list_type]" class="w-full border border-gray-300 rounded-lg px-2 py-1.5 text-sm">
                        <option value="ul">Bullet List</option>
                        <option value="ol">Numbered List</option>
                    </select>
                </div>
            </div>
            <div contenteditable="true"
                 data-block-type="list"
                 data-index="${idx}"
                 class="paragraph-editor w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 min-h-[120px]"
                 onfocus="setCurrentEditor(this)"
                 onclick="setCurrentEditor(this)"
                 onkeyup="saveSelection()"
                 onmouseup="saveSelection()"
                 oninput="syncContent(this,${idx})"
                 placeholder="• Item 1&#10;• Item 2&#10;• Item 3"></div>
            <input type="hidden" name="blocks[${idx}][content]" id="content-${idx}">`;
        }

        // Insert block controls
        inner += `
        <div class="flex items-center gap-2 mt-3 pt-3 border-t border-gray-100">
            <span class="text-xs text-gray-400">Insert below:</span>
            <button type="button" onclick="insertBlockAfter('heading',this)"
                    class="text-xs px-2 py-1 rounded border border-gray-200 hover:bg-gray-100 font-bold">H</button>
            <button type="button" onclick="insertBlockAfter('text',this)"
                    class="text-xs px-2 py-1 rounded border border-gray-200 hover:bg-gray-100">¶</button>
            <button type="button" onclick="insertBlockAfter('image',this)"
                    class="text-xs px-2 py-1 rounded border border-gray-200 hover:bg-gray-100">🖼️</button>
            <button type="button" onclick="insertBlockAfter('list',this)"
                    class="text-xs px-2 py-1 rounded border border-gray-200 hover:bg-gray-100">📋</button>
        </div>`;

        div.innerHTML = inner;
        return div;
    }

    // ── ADD / INSERT / REMOVE ──────────────────────────────
    window.addBlock = function(type) {
        document.getElementById('blocks-empty-msg')?.remove();
        const newBlock = buildBlock(type, blockIndex++);
        document.getElementById('blocks-container').appendChild(newBlock);
        if (type === 'text' || type === 'list') {
            const editor = newBlock.querySelector('.paragraph-editor');
            if (editor) {
                editor.focus();
                currentEditorForLink = editor;
            }
        }
    };

    window.insertBlockAfter = function(type, btn) {
        document.getElementById('blocks-empty-msg')?.remove();
        const ref = btn.closest('.block-item');
        const div = buildBlock(type, blockIndex++);
        if (ref) {
            ref.insertAdjacentElement('afterend', div);
        } else {
            document.getElementById('blocks-container').appendChild(div);
        }
        if (type === 'text' || type === 'list') {
            const editor = div.querySelector('.paragraph-editor');
            if (editor) editor.focus();
        }
    };

    window.removeBlock = function(btn) {
        const block = btn.closest('.block-item');
        delete blockFiles[block.dataset.index];
        block.remove();
        if (!document.querySelector('.block-item')) {
            document.getElementById('blocks-container').innerHTML = `
                <div id="blocks-empty-msg" class="text-center py-10 text-gray-400 border-2 border-dashed border-gray-200 rounded-lg">
                    <p class="text-sm">Your page is empty.</p>
                    <p class="text-xs mt-1">Use the toolbar at the bottom to add content blocks.</p>
                </div>`;
        }
    };

    // ── CONTENT SYNC ────────────────────────────────────────
    window.syncContent = function(el, idx) {
        const h = document.getElementById('content-' + idx);
        if (h) h.value = el.innerHTML;
    };

    // ── HEADING PREVIEW ──────────────────────────────────────
    window.updateHeadingPreview = function(el) {
        const block  = el.closest('.block-item');
        const level  = block.querySelector('select').value;
        const text   = block.querySelector('.heading-text').value || 'Preview appears here...';
        const styles = {
            h1: 'text-3xl font-bold text-gray-900',
            h2: 'text-2xl font-bold text-gray-800',
            h3: 'text-xl font-semibold text-gray-800',
            h4: 'text-lg font-semibold text-gray-700',
            h5: 'text-base font-semibold text-gray-700',
            h6: 'text-sm font-semibold text-gray-600'
        };
        block.querySelector('.heading-preview').innerHTML =
            `<${level} class="${styles[level]} not-italic">${escapeHtml(text)}</${level}>`;
    };

    // ── IMAGES ──────────────────────────────────────────────

    // ✅ FIX: accumulateImages stores files in blockFiles[idx],
    // then calls syncFilesToInput() which assigns them to the REAL
    // persistent <input type="file"> via DataTransfer.
    // The key difference from the old code: the input already exists
    // in the DOM before we assign files, so the browser will include
    // it in the multipart form submission.
    window.accumulateImages = function(input, idx) {
        if (!blockFiles[idx]) blockFiles[idx] = [];
        Array.from(input.files).forEach(f => {
            if (!blockFiles[idx].some(x => x.name === f.name && x.size === f.size)) {
                blockFiles[idx].push(f);
            }
        });
        input.value = ''; // reset the picker so same file can be picked again
        renderImageGrid(idx);
        syncFilesToInput(idx); // ✅ keep the real input in sync
    };

    // ✅ FIX: Assign accumulated files to the persistent DOM input.
    // This input was created in buildBlock() and lives in the DOM permanently.
    function syncFilesToInput(idx) {
        const realInput = document.getElementById('img-file-input-' + idx);
        if (!realInput) return;

        const dt = new DataTransfer();
        (blockFiles[idx] || []).forEach(f => dt.items.add(f));
        realInput.files = dt.files;
    }

    function renderImageGrid(idx) {
        const grid  = document.getElementById('img-grid-' + idx);
        const count = document.getElementById('img-count-' + idx);
        const files = blockFiles[idx] || [];

        if (count) count.textContent = files.length ? `(${files.length})` : '';
        if (!grid) return;
        grid.innerHTML = '';

        files.forEach((file, i) => {
            const wrapper = document.createElement('div');
            wrapper.className = 'border border-gray-200 rounded-lg overflow-hidden bg-white';

            const imgWrapper = document.createElement('div');
            imgWrapper.className = 'relative';

            const img      = document.createElement('img');
            img.src        = URL.createObjectURL(file);
            img.className  = 'w-full object-cover';
            img.style.height = '100px';

            const removeBtn       = document.createElement('button');
            removeBtn.type        = 'button';
            removeBtn.className   = 'absolute top-1 right-1 bg-red-500 text-white rounded-full w-5 h-5 text-xs flex items-center justify-center hover:bg-red-600';
            removeBtn.innerHTML   = '&times;';
            removeBtn.onclick     = () => {
                blockFiles[idx].splice(i, 1);
                renderImageGrid(idx);
                syncFilesToInput(idx); // ✅ keep real input in sync after removal
            };

            const altWrapper  = document.createElement('div');
            altWrapper.className = 'p-2 bg-gray-50';

            const altInput        = document.createElement('input');
            altInput.type         = 'text';
            altInput.name         = `blocks[${idx}][alts][${i}]`;
            altInput.placeholder  = 'Alt text for this image';
            altInput.className    = 'w-full border border-gray-200 rounded px-2 py-1 text-xs focus:outline-none focus:ring-1 focus:ring-blue-500';

            imgWrapper.appendChild(img);
            imgWrapper.appendChild(removeBtn);
            altWrapper.appendChild(altInput);
            wrapper.appendChild(imgWrapper);
            wrapper.appendChild(altWrapper);
            grid.appendChild(wrapper);
        });
    }

    // ── LINK HANDLING ────────────────────────────────────────
    window.saveSelection = function() {
        const sel = window.getSelection();
        if (sel && !sel.isCollapsed && sel.toString().trim()) {
            savedSelectionRange = sel.getRangeAt(0).cloneRange();
            const editor = sel.anchorNode?.nodeType === 3
                ? sel.anchorNode.parentElement?.closest('[data-block-type="text"], [data-block-type="list"]')
                : sel.anchorNode?.closest('[data-block-type="text"], [data-block-type="list"]');
            if (editor) currentEditorForLink = editor;
        } else {
            savedSelectionRange = null;
        }
    };

    window.setCurrentEditor = function(el) {
        currentEditorForLink = el;
    };

    function openLinkModal() {
        if (!currentEditorForLink) {
            alert('Please click inside a paragraph or list first, then click Add Link.');
            return;
        }
        currentEditorForLink.focus();
        const sel          = window.getSelection();
        const selectedText = sel && !sel.isCollapsed ? sel.toString().trim() : '';

        document.getElementById('modal-link-text').value = selectedText || '';
        document.getElementById('modal-link-url').value  = '';
        document.getElementById('modal-link-error').classList.add('hidden');

        const m = document.getElementById('link-modal');
        m.classList.remove('hidden');
        m.classList.add('flex');

        if (!selectedText) {
            document.getElementById('modal-link-text').focus();
        } else {
            document.getElementById('modal-link-url').focus();
        }
    }

    window.closeLinkModal = function() {
        const m = document.getElementById('link-modal');
        m.classList.add('hidden');
        m.classList.remove('flex');
        savedSelectionRange = null;
    };

    window.insertInlineLink = function() {
        const linkText = document.getElementById('modal-link-text').value.trim();
        const linkUrl  = document.getElementById('modal-link-url').value.trim();

        if (!linkText || !linkUrl) {
            document.getElementById('modal-link-error').classList.remove('hidden');
            return;
        }
        if (!currentEditorForLink) { closeLinkModal(); return; }

        currentEditorForLink.focus();
        if (savedSelectionRange) {
            const sel = window.getSelection();
            sel.removeAllRanges();
            sel.addRange(savedSelectionRange);
        }

        const linkHtml = `<a href="${escapeHtml(linkUrl)}" target="_blank" rel="noopener noreferrer">${escapeHtml(linkText)}</a>`;
        document.execCommand('insertHTML', false, linkHtml);

        const idx         = currentEditorForLink.dataset.index;
        const hiddenInput = document.getElementById('content-' + idx);
        if (hiddenInput) hiddenInput.value = currentEditorForLink.innerHTML;

        savedSelectionRange = null;
        closeLinkModal();
    };

    window.closeEditLinkModal = function() {
        const m = document.getElementById('edit-link-modal');
        m.classList.add('hidden');
        m.classList.remove('flex');
        currentEditingLink   = null;
        currentEditingEditor = null;
    };

    window.saveEditedLink = function() {
        if (!currentEditingLink || !currentEditingEditor) return;
        const newText = document.getElementById('edit-link-text').value.trim();
        const newUrl  = document.getElementById('edit-link-url').value.trim();
        if (!newText || !newUrl) return;

        const newLink       = document.createElement('a');
        newLink.href        = newUrl;
        newLink.target      = '_blank';
        newLink.rel         = 'noopener noreferrer';
        newLink.textContent = newText;
        currentEditingLink.parentNode.replaceChild(newLink, currentEditingLink);

        const idx         = currentEditingEditor.dataset.index;
        const hiddenInput = document.getElementById('content-' + idx);
        if (hiddenInput) hiddenInput.value = currentEditingEditor.innerHTML;

        closeEditLinkModal();
    };

    window.removeCurrentLink = function() {
        if (!currentEditingLink || !currentEditingEditor) return;
        const text = document.createTextNode(currentEditingLink.textContent);
        currentEditingLink.parentNode.replaceChild(text, currentEditingLink);

        const idx         = currentEditingEditor.dataset.index;
        const hiddenInput = document.getElementById('content-' + idx);
        if (hiddenInput) hiddenInput.value = currentEditingEditor.innerHTML;

        closeEditLinkModal();
    };

    document.addEventListener('dblclick', function(e) {
        const link = e.target.closest('a');
        if (link && link.closest('[data-block-type="text"], [data-block-type="list"]')) {
            e.preventDefault();
            e.stopPropagation();

            currentEditingLink   = link;
            currentEditingEditor = link.closest('[data-block-type="text"], [data-block-type="list"]');

            document.getElementById('edit-link-text').value = link.textContent;
            document.getElementById('edit-link-url').value  = link.href;

            const m = document.getElementById('edit-link-modal');
            m.classList.remove('hidden');
            m.classList.add('flex');
        }
    });

    // ── MODAL BACKDROP CLOSE ─────────────────────────────────
    document.getElementById('link-modal').addEventListener('click', function(e) {
        if (e.target === this) closeLinkModal();
    });
    document.getElementById('edit-link-modal').addEventListener('click', function(e) {
        if (e.target === this) closeEditLinkModal();
    });

    // ── ADD LINK BUTTON ──────────────────────────────────────
    document.getElementById('global-add-link-btn').addEventListener('click', openLinkModal);

    // ── SLUG GENERATION ──────────────────────────────────────
    document.addEventListener('DOMContentLoaded', function() {
        const nameInput = document.getElementById('name-input');
        const slugInput = document.getElementById('slug-input');
        if (nameInput && slugInput) {
            nameInput.addEventListener('input', function() {
                if (slugInput.dataset.manual !== 'true') {
                    slugInput.value = this.value.toLowerCase().trim()
                        .replace(/[^a-z0-9\s-]/g, '').replace(/\s+/g, '-');
                }
            });
            slugInput.addEventListener('input', function() {
                this.dataset.manual = 'true';
            });
        }
    });

    // ── IMAGE PREVIEWS (sidebar) ─────────────────────────────
    window.previewFeaturedImage = function(input) {
        if (!input.files[0]) return;
        document.getElementById('featured-preview-img').src = URL.createObjectURL(input.files[0]);
        document.getElementById('featured-preview').classList.remove('hidden');
        document.getElementById('featured-upload-prompt').classList.add('hidden');
    };
    window.removeFeaturedImage = function() {
        document.getElementById('featured-image-input').value = '';
        document.getElementById('featured-preview').classList.add('hidden');
        document.getElementById('featured-upload-prompt').classList.remove('hidden');
    };
    window.previewMainImage = function(input) {
        if (!input.files[0]) return;
        document.getElementById('main-preview-img').src = URL.createObjectURL(input.files[0]);
        document.getElementById('main-preview').classList.remove('hidden');
        document.getElementById('main-upload-prompt').classList.add('hidden');
    };
    window.removeMainImage = function() {
        document.getElementById('main-image-input').value = '';
        document.getElementById('main-preview').classList.add('hidden');
        document.getElementById('main-upload-prompt').classList.remove('hidden');
    };

    // ── PASTE CLEANUP ────────────────────────────────────────
    document.addEventListener('paste', function(e) {
        const target = e.target;
        if (target && target.matches && target.matches('[data-block-type="text"], [data-block-type="list"]')) {
            e.preventDefault();
            const text = (e.clipboardData || window.clipboardData).getData('text/plain');
            document.execCommand('insertText', false, text);
        }
    });

    // ── FORM SUBMIT ──────────────────────────────────────────
    // ✅ FIX: Re-sync all real file inputs AND all contenteditable hidden inputs
    // just before the browser serializes the form for submission.
    document.getElementById('destination-form').addEventListener('submit', function(e) {
        // Re-sync all image blocks — ensures DataTransfer FileList is current
        Object.keys(blockFiles).forEach(idx => {
            syncFilesToInput(idx);
        });

        // Sync all paragraph/list editors to their hidden inputs
        document.querySelectorAll('.paragraph-editor').forEach(el => {
            const idx = el.dataset.index;
            const h   = document.getElementById('content-' + idx);
            if (h) h.value = el.innerHTML;
        });
    });

    // ── HELPER ───────────────────────────────────────────────
    window.escapeHtml = function(str) {
        if (!str) return '';
        return str.replace(/[&<>"']/g, function(m) {
            return { '&':'&amp;', '<':'&lt;', '>':'&gt;', '"':'&quot;', "'": '&#39;' }[m];
        });
    };

})();
</script>
@endpush
@endsection