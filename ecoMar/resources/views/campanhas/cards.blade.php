@php
    // Normalize country for section id
    function countrySectionId($country) {
        return 'section-' . strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $country));
    }
    $countryRendered = [];
@endphp
@forelse($campaigns as $campaign)
    <div class="custom-card campaign-block {{ $campaign->is_large ? '' : 'small-block' }}"
         @if(!in_array($campaign->country, $countryRendered))
            id="{{ countrySectionId($campaign->country) }}"
            @php $countryRendered[] = $campaign->country; @endphp
         @endif
         onclick="toggleExpand(this)"
         onkeydown="if(event.key==='Enter'){ toggleExpand(this); }"
         tabindex="0">
        <div class="card-content">
            <div>
                <div class="card-title">{{ $campaign->country }}</div>
                <div class="card-subtitle">{{ $campaign->title }}</div>
                <p class="card-text">
                    {{ $campaign->description }}
                </p>
            </div>
            <div class="progress-container">
                <div class="progress-label">
                    <span>{{ $campaign->goal_current }} kg</span>
                    <span>{{ $campaign->goal_current }} kg / {{ $campaign->goal }} kg</span>
                </div>
                <div class="progress">
                    @php
                        $percentage = ($campaign->goal > 0) ? ($campaign->goal_current / $campaign->goal) * 100 : 0;
                        $percentage = min($percentage, 100);
                    @endphp
                    <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        @php
            $imagePath = str_starts_with($campaign->image, 'campaigns/') 
                ? asset('storage/' . $campaign->image) 
                : asset('img/' . $campaign->image);
        @endphp
        <div class="card-image" style="background-image: url({{ $imagePath }});"></div>
    </div>
@empty

@endforelse
