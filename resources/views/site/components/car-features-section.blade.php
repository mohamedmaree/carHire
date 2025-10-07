<!-- Car Features Section -->
<div class="car-features-section" style="background-color: #f8f9fa; padding: 20px; border-radius: 8px;">
    <div class="features-container">
        <!-- Features List -->
        <div class="features-list">
            @if(isset($car['features']) && count($car['features']) > 0)
                @foreach($car['features'] as $index => $feature)
                    @if($index < 3)
                        <!-- Top Row Features (Highlighted) -->
                        <div class="feature-item highlighted" style="display: inline-block; margin-right: 20px; margin-bottom: 10px;">
                            <div class="feature-content" style="display: flex; align-items: center;">
                                <div class="feature-icon mr-2" style="color: #ff6b35;">
                                    @if($index == 0)
                                        <i class="fas fa-check" style="font-size: 16px;"></i>
                                    @else
                                        <i class="fas fa-circle" style="font-size: 8px;"></i>
                                    @endif
                                </div>
                                <div class="feature-text" style="color: #333; font-weight: 500;">
                                    {{ $feature['text'] }}
                                </div>
                            </div>
                            @if($index == 0)
                                <div class="highlight-line" style="height: 2px; background-color: #ff6b35; margin-top: 5px;"></div>
                            @endif
                        </div>
                    @else
                        <!-- Bottom List Features -->
                        <div class="feature-item regular mb-2" style="display: flex; align-items: center;">
                            <div class="feature-icon mr-3" style="color: #ff6b35;">
                                <i class="fas fa-circle" style="font-size: 6px;"></i>
                            </div>
                            <div class="feature-text" style="color: #666; font-size: 14px;">
                                {{ $feature['text'] }}
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="text-center text-muted">
                    <p>No features available</p>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.car-features-section {
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.feature-item.highlighted {
    border-bottom: 2px solid transparent;
    transition: all 0.3s ease;
}

.feature-item.highlighted:hover {
    transform: translateY(-2px);
}

.feature-item.regular:hover {
    color: #ff6b35;
    transition: color 0.3s ease;
}

@media (max-width: 768px) {
    .highlighted-features .feature-item {
        display: block !important;
        margin-right: 0 !important;
        margin-bottom: 15px !important;
    }
    
    .feature-content {
        flex-direction: column !important;
        align-items: flex-start !important;
    }
    
    .feature-icon {
        margin-bottom: 5px;
    }
}
</style>
