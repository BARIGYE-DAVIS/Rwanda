@extends('layouts.admin')

@section('title', 'Booking Requests - Admin Dashboard')

@section('content')
<div class="container-fluid px-4 py-6">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 mb-2">Booking Requests</h1>
                <p class="text-gray-600">Manage and respond to customer booking inquiries</p>
            </div>
            <div class="mt-4 sm:mt-0 flex space-x-3">
                <a href="{{ route('admin.contacts.export') }}" 
                   class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 transition ease-in-out duration-150">
                    <i class="fas fa-download mr-2"></i>
                    Export CSV
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    @php
        $stats = App\Models\ContactMessage::getStats();
    @endphp
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-ticket-alt text-blue-600"></i>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Bookings</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ number_format($stats['total']) }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-clock text-yellow-600"></i>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Pending</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ number_format($stats['pending']) }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-check-circle text-purple-600"></i>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Confirmed</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ number_format($stats['confirmed']) }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-calendar-alt text-green-600"></i>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">This Month</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ number_format($stats['this_month']) }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="bg-white shadow rounded-lg mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Filters & Search</h3>
        </div>
        <div class="px-6 py-4">
            <form method="GET" action="{{ route('admin.contacts.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Search -->
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                    <div class="relative">
                        <input type="text" 
                               name="search" 
                               id="search"
                               value="{{ request('search') }}"
                               placeholder="Name, email, destination..."
                               class="w-full px-3 py-2 pl-10 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400"></i>
                        </div>
                    </div>
                </div>

                <!-- Status Filter -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" id="status" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                        <option value="">All Statuses</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ request('status') === 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="quoted" {{ request('status') === 'quoted' ? 'selected' : '' }}>Quoted</option>
                        <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>

                <!-- Destination Filter -->
                <div>
                    <label for="destination" class="block text-sm font-medium text-gray-700 mb-1">Destination</label>
                    <select name="destination" id="destination" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
                        <option value="">All Destinations</option>
                        @php
                            $destinations = App\Models\ContactMessage::whereNotNull('destination')
                                ->selectRaw('destination, COUNT(*) as count')
                                ->groupBy('destination')
                                ->orderBy('count', 'desc')
                                ->get();
                        @endphp
                        @foreach($destinations as $dest)
                            <option value="{{ $dest->destination }}" {{ request('destination') === $dest->destination ? 'selected' : '' }}>
                                {{ $dest->destination }} ({{ $dest->count }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Actions -->
                <div class="flex items-end space-x-2">
                    <button type="submit" class="px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 transition ease-in-out duration-150">
                        <i class="fas fa-filter mr-1"></i> Filter
                    </button>
                    <a href="{{ route('admin.contacts.index') }}" class="px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-400 transition ease-in-out duration-150">
                        <i class="fas fa-times mr-1"></i> Clear
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bookings Table -->
    <div class="bg-white shadow overflow-hidden rounded-md">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-900">
                Booking Requests 
                @if(request()->hasAny(['search', 'status', 'destination']))
                    <span class="text-sm text-gray-500">(Filtered Results)</span>
                @endif
            </h3>
            
            @if($contacts->count() > 0)
            <!-- Bulk Actions -->
            <div class="flex items-center space-x-3">
                <select id="bulkAction" class="px-3 py-2 border border-gray-300 rounded-md text-sm">
                    <option value="">Bulk Actions</option>
                    <option value="mark_processing">Mark as Processing</option>
                    <option value="mark_quoted">Mark as Quoted</option>
                    <option value="mark_confirmed">Mark as Confirmed</option>
                    <option value="mark_cancelled">Mark as Cancelled</option>
                    <option value="delete">Delete</option>
                </select>
                <button type="button" id="applyBulkAction" class="px-3 py-2 bg-gray-600 text-white text-sm rounded-md hover:bg-gray-700">
                    <i class="fas fa-check mr-1"></i> Apply
                </button>
            </div>
            @endif
        </div>

        @if($contacts->count() > 0)
        <!-- Bookings List -->
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left">
                            <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Contact Info
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Trip Details
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($contacts as $contact)
                    <tr class="hover:bg-gray-50 {{ $contact->status === 'pending' ? 'bg-blue-50 border-l-4 border-blue-400' : '' }}">
                        <!-- Checkbox -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="checkbox" name="selected_contacts[]" value="{{ $contact->id }}" class="contact-checkbox rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50">
                        </td>

                        <!-- Contact Info -->
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <div class="h-10 w-10 rounded-full bg-{{ $contact->status === 'pending' ? 'blue' : 'gray' }}-100 flex items-center justify-center">
                                        <i class="fas fa-user text-{{ $contact->status === 'pending' ? 'blue' : 'gray' }}-600"></i>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $contact->first_name }} {{ $contact->last_name }}</div>
                                    <div class="text-sm text-gray-500">
                                        <i class="fas fa-envelope mr-1"></i>{{ $contact->email }}
                                    </div>
                                    <div class="text-xs text-gray-500 mt-1">
                                        @if($contact->whatsapp_number)
                                        <span class="inline-flex items-center mr-3">
                                            <i class="fab fa-whatsapp mr-1 text-green-600"></i>
                                            {{ $contact->whatsapp_number }}
                                        </span>
                                        @endif
                                        @if($contact->nationality)
                                        <span class="inline-flex items-center">
                                            <i class="fas fa-flag mr-1"></i>
                                            {{ $contact->nationality }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>

                        <!-- Trip Details -->
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">
                                <span class="font-medium">Destination:</span> {{ $contact->destination ?? 'N/A' }}
                            </div>
                            <div class="text-sm text-gray-600">
                                <span class="font-medium">People:</span> {{ $contact->number_of_people ?? 'N/A' }}
                                | <span class="font-medium">Days:</span> {{ $contact->number_of_days ?? 'N/A' }}
                            </div>
                            <div class="text-xs text-gray-500 mt-1">
                                <span class="font-medium">Budget:</span> {{ $contact->formatted_budget ?? 'N/A' }}
                                | <span class="font-medium">Accommodation:</span> {{ $contact->accommodation_list ?? 'N/A' }}
                            </div>
                            @if($contact->preferred_travel_date)
                            <div class="text-xs text-gray-500">
                                <i class="fas fa-calendar-alt mr-1"></i> {{ $contact->preferred_travel_date }}
                            </div>
                            @endif
                        </td>

                        <!-- Status -->
                        <td class="px-6 py-4 whitespace-nowrap">
                            @php
                                $statusColors = [
                                    'pending' => 'yellow',
                                    'processing' => 'blue',
                                    'quoted' => 'purple',
                                    'confirmed' => 'green',
                                    'cancelled' => 'red'
                                ];
                                $statusIcons = [
                                    'pending' => 'fa-clock',
                                    'processing' => 'fa-spinner',
                                    'quoted' => 'fa-file-invoice',
                                    'confirmed' => 'fa-check-circle',
                                    'cancelled' => 'fa-times-circle'
                                ];
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $statusColors[$contact->status] ?? 'gray' }}-100 text-{{ $statusColors[$contact->status] ?? 'gray' }}-800">
                                <i class="fas {{ $statusIcons[$contact->status] ?? 'fa-circle' }} mr-1"></i>
                                {{ ucfirst($contact->status) }}
                            </span>
                        </td>

                        <!-- Date -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div>{{ $contact->created_at->format('M d, Y') }}</div>
                            <div class="text-xs text-gray-400">{{ $contact->created_at->format('H:i A') }}</div>
                            <div class="text-xs text-gray-400">{{ $contact->created_at->diffForHumans() }}</div>
                        </td>

                        <!-- Actions -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('admin.contacts.show', $contact->id) }}" 
                                   class="text-green-600 hover:text-green-900 transition-colors" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <button type="button" 
                                        class="text-blue-600 hover:text-blue-900 transition-colors toggle-status" 
                                        data-id="{{ $contact->id }}" 
                                        data-status="{{ $contact->status }}"
                                        title="Change Status">
                                    <i class="fas fa-sync-alt"></i>
                                </button>

                                <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this booking request?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 transition-colors" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            {{ $contacts->links() }}
        </div>
        @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <i class="fas fa-inbox text-gray-400 text-5xl mb-4"></i>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No booking requests</h3>
            <p class="mt-1 text-sm text-gray-500">
                @if(request()->hasAny(['search', 'status', 'destination']))
                    No bookings match your current filters.
                @else
                    No booking requests have been received yet.
                @endif
            </p>
            @if(request()->hasAny(['search', 'status', 'destination']))
            <div class="mt-6">
                <a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                    <i class="fas fa-times mr-2"></i> Clear Filters
                </a>
            </div>
            @endif
        </div>
        @endif
    </div>
</div>

<!-- Bulk Action Form -->
<form id="bulkActionForm" action="{{ route('admin.contacts.bulk') }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="action" id="bulkActionType">
    <div id="bulkContactIds"></div>
</form>

@push('styles')
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select All Functionality
    const selectAllCheckbox = document.getElementById('selectAll');
    const contactCheckboxes = document.querySelectorAll('.contact-checkbox');

    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            contactCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    }

    // Individual checkbox change
    contactCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const checkedBoxes = document.querySelectorAll('.contact-checkbox:checked');
            selectAllCheckbox.checked = checkedBoxes.length === contactCheckboxes.length;
        });
    });

    // Bulk Actions
    const bulkActionSelect = document.getElementById('bulkAction');
    const applyBulkActionBtn = document.getElementById('applyBulkAction');
    const bulkActionForm = document.getElementById('bulkActionForm');

    if (applyBulkActionBtn) {
        applyBulkActionBtn.addEventListener('click', function() {
            const selectedAction = bulkActionSelect.value;
            const checkedBoxes = document.querySelectorAll('.contact-checkbox:checked');

            if (!selectedAction) {
                alert('Please select an action.');
                return;
            }

            if (checkedBoxes.length === 0) {
                alert('Please select at least one booking.');
                return;
            }

            // Confirm delete action
            if (selectedAction === 'delete') {
                if (!confirm('Are you sure you want to delete the selected bookings? This action cannot be undone.')) {
                    return;
                }
            }

            // Prepare form data
            document.getElementById('bulkActionType').value = selectedAction;
            const bulkContactIds = document.getElementById('bulkContactIds');
            bulkContactIds.innerHTML = '';

            checkedBoxes.forEach(checkbox => {
                const hiddenInput = document.createElement('input');
                hiddenInput.type = 'hidden';
                hiddenInput.name = 'contact_ids[]';
                hiddenInput.value = checkbox.value;
                bulkContactIds.appendChild(hiddenInput);
            });

            // Submit form
            bulkActionForm.submit();
        });
    }

    // Toggle Status (you can implement a status dropdown or modal here)
    document.querySelectorAll('.toggle-status').forEach(button => {
        button.addEventListener('click', function() {
            const contactId = this.dataset.id;
            const currentStatus = this.dataset.status;
            
            // Simple status update - you can replace with a modal for better UX
            const newStatus = prompt('Enter new status (pending, processing, quoted, confirmed, cancelled):', currentStatus);
            
            if (newStatus && ['pending', 'processing', 'quoted', 'confirmed', 'cancelled'].includes(newStatus)) {
                fetch(`/admin/contacts/${contactId}/status`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        status: newStatus
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Failed to update status. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                });
            } else if (newStatus !== null) {
                alert('Invalid status. Please use: pending, processing, quoted, confirmed, or cancelled.');
            }
        });
    });
});
</script>
@endpush
@endsection