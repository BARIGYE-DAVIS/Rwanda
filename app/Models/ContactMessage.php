<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ContactMessage extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'booking_requests';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'whatsapp_number',
        'nationality',
        'destination',
        'number_of_people',
        'number_of_days',
        'accommodation_type',
        'preferred_travel_date',
        'estimated_budget',
        'additional_comments',
        'status',
        'ip_address',
        'user_agent',
        'read_at',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'accommodation_type' => 'array',
        'estimated_budget' => 'decimal:2',
        'read_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the full name
     */
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Get accommodation types as array
     */
    public function getAccommodationTypesAttribute()
    {
        return is_array($this->accommodation_type) 
            ? $this->accommodation_type 
            : json_decode($this->accommodation_type ?? '[]', true);
    }

    /**
     * Get accommodation types as comma-separated string
     */
    public function getAccommodationListAttribute()
    {
        $types = $this->accommodation_types;
        $labels = [];

        $accommodationMap = [
            'budget' => 'Budget',
            'mid_range' => 'Mid range',
            'luxury' => 'Luxury',
        ];

        foreach ($types as $type) {
            if (isset($accommodationMap[$type])) {
                $labels[] = $accommodationMap[$type];
            }
        }

        return implode(', ', $labels);
    }

    /**
     * Get formatted budget
     */
    public function getFormattedBudgetAttribute()
    {
        if (!$this->estimated_budget) {
            return null;
        }

        return '$' . number_format($this->estimated_budget, 0);
    }

    /**
     * Get time since created (human readable)
     */
    public function getTimeSinceAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute()
    {
        $statuses = [
            'pending' => 'Pending',
            'processing' => 'Processing',
            'quoted' => 'Quoted',
            'confirmed' => 'Confirmed',
            'cancelled' => 'Cancelled',
        ];

        return $statuses[$this->status] ?? ucfirst($this->status);
    }

    /**
     * Get status color
     */
    public function getStatusColorAttribute()
    {
        $colors = [
            'pending' => 'yellow',
            'processing' => 'blue',
            'quoted' => 'purple',
            'confirmed' => 'green',
            'cancelled' => 'red',
        ];

        return $colors[$this->status] ?? 'gray';
    }

    /**
     * Check if booking needs attention
     */
    public function getNeedsAttentionAttribute()
    {
        return in_array($this->status, ['pending', 'processing']);
    }

    /**
     * Mark booking as read
     */
    public function markAsRead()
    {
        $this->update(['read_at' => now()]);
        return $this;
    }

    /**
     * Mark booking as processing
     */
    public function markAsProcessing()
    {
        $this->update([
            'status' => 'processing',
            'read_at' => $this->read_at ?? now(),
        ]);
        return $this;
    }

    /**
     * Mark booking as quoted
     */
    public function markAsQuoted()
    {
        $this->update([
            'status' => 'quoted',
            'read_at' => $this->read_at ?? now(),
        ]);
        return $this;
    }

    /**
     * Mark booking as confirmed
     */
    public function markAsConfirmed()
    {
        $this->update([
            'status' => 'confirmed',
            'read_at' => $this->read_at ?? now(),
        ]);
        return $this;
    }

    /**
     * Mark booking as cancelled
     */
    public function markAsCancelled()
    {
        $this->update(['status' => 'cancelled']);
        return $this;
    }

    /**
     * Scope: Get pending bookings
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope: Get bookings by status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope: Get recent bookings
     */
    public function scopeRecent($query, $days = 7)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Scope: Get bookings from this month
     */
    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
    }

    /**
     * Scope: Get bookings from this week
     */
    public function scopeThisWeek($query)
    {
        return $query->whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ]);
    }

    /**
     * Scope: Get bookings from today
     */
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    /**
     * Scope: Search bookings
     */
    public function scopeSearch($query, $search)
    {
        if (!$search) {
            return $query;
        }

        return $query->where(function ($q) use ($search) {
            $q->where('first_name', 'like', "%{$search}%")
              ->orWhere('last_name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('whatsapp_number', 'like', "%{$search}%")
              ->orWhere('destination', 'like', "%{$search}%")
              ->orWhere('nationality', 'like', "%{$search}%");
        });
    }

    /**
     * Scope: Filter by date range
     */
    public function scopeDateRange($query, $from, $to)
    {
        if ($from && $to) {
            return $query->whereBetween('created_at', [
                Carbon::parse($from)->startOfDay(),
                Carbon::parse($to)->endOfDay()
            ]);
        } elseif ($from) {
            return $query->where('created_at', '>=', Carbon::parse($from)->startOfDay());
        } elseif ($to) {
            return $query->where('created_at', '<=', Carbon::parse($to)->endOfDay());
        }

        return $query;
    }

    /**
     * Scope: Filter by accommodation type
     */
    public function scopeWithAccommodation($query, $type)
    {
        return $query->whereJsonContains('accommodation_type', $type);
    }

    /**
     * Scope: Filter by budget range
     */
    public function scopeBudgetRange($query, $min, $max)
    {
        if ($min && $max) {
            return $query->whereBetween('estimated_budget', [$min, $max]);
        } elseif ($min) {
            return $query->where('estimated_budget', '>=', $min);
        } elseif ($max) {
            return $query->where('estimated_budget', '<=', $max);
        }

        return $query;
    }

    /**
     * Get booking statistics
     */
    public static function getStats()
    {
        return [
            'total' => self::count(),
            'pending' => self::where('status', 'pending')->count(),
            'processing' => self::where('status', 'processing')->count(),
            'quoted' => self::where('status', 'quoted')->count(),
            'confirmed' => self::where('status', 'confirmed')->count(),
            'cancelled' => self::where('status', 'cancelled')->count(),
            'this_month' => self::thisMonth()->count(),
            'this_week' => self::thisWeek()->count(),
            'today' => self::today()->count(),
        ];
    }

    /**
     * Get destination statistics
     */
    public static function getDestinationStats()
    {
        return self::whereNotNull('destination')
                   ->selectRaw('destination, COUNT(*) as count')
                   ->groupBy('destination')
                   ->orderBy('count', 'desc')
                   ->pluck('count', 'destination')
                   ->toArray();
    }

    /**
     * Get accommodation statistics
     */
    public static function getAccommodationStats()
    {
        $types = ['budget', 'mid_range', 'luxury'];
        $stats = [];

        foreach ($types as $type) {
            $stats[$type] = self::withAccommodation($type)->count();
        }

        return $stats;
    }

    /**
     * Get monthly booking trends
     */
    public static function getMonthlyTrends($months = 12)
    {
        return self::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
                   ->where('created_at', '>=', now()->subMonths($months))
                   ->groupBy('year', 'month')
                   ->orderBy('year')
                   ->orderBy('month')
                   ->get()
                   ->map(function ($item) {
                       return [
                           'date' => Carbon::createFromDate($item->year, $item->month, 1)->format('M Y'),
                           'count' => $item->count
                       ];
                   });
    }

    /**
     * Get the route key for the model
     */
    public function getRouteKeyName()
    {
        return 'id';
    }

    /**
     * Convert to array for API responses
     */
    public function toApiArray()
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'full_name' => $this->full_name,
            'email' => $this->email,
            'whatsapp_number' => $this->whatsapp_number,
            'nationality' => $this->nationality,
            'destination' => $this->destination,
            'number_of_people' => $this->number_of_people,
            'number_of_days' => $this->number_of_days,
            'accommodation_type' => $this->accommodation_types,
            'accommodation_list' => $this->accommodation_list,
            'preferred_travel_date' => $this->preferred_travel_date,
            'estimated_budget' => $this->estimated_budget,
            'formatted_budget' => $this->formatted_budget,
            'additional_comments' => $this->additional_comments,
            'status' => $this->status,
            'status_label' => $this->status_label,
            'status_color' => $this->status_color,
            'needs_attention' => $this->needs_attention,
            'time_since' => $this->time_since,
            'created_at' => $this->created_at->toISOString(),
            'read_at' => $this->read_at?->toISOString(),
        ];
    }
}