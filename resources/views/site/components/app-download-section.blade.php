<!-- App Download Section -->
<section class="app-download-section py-5" style="background-color: #ff6b35; color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-7 col-12 mb-4 mb-md-0">
                <h2 class="app-download-title mb-3" style="font-size: 2.5rem; font-weight: bold; color: black;">
                    {{ $app_download['title'] }}
                </h2>
                <p class="app-download-description" style="font-size: 1.1rem; color: black; line-height: 1.6;">
                    {{ $app_download['description'] }}
                </p>
            </div>
            <div class="col-lg-4 col-md-5 col-12 text-center">
                <div class="app-download-buttons">
                    <!-- Google Play Button -->
                    <a href="{{ $app_download['google_play_link'] }}" target="_blank" class="btn btn-dark btn-lg mb-3 d-block" 
                       style="border: 2px solid white; border-radius: 8px; padding: 15px 20px; text-decoration: none;">
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="mr-3">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M3.609 1.814L13.792 12L3.609 22.186C3.609 22.186 3.609 1.814 3.609 1.814ZM14.391 1.814L24.574 12L14.391 22.186C14.391 22.186 14.391 1.814 14.391 1.814Z" fill="white"/>
                                    <path d="M9 12L3.609 1.814L14.391 1.814L9 12Z" fill="white"/>
                                </svg>
                            </div>
                            <div class="text-left">
                                <div style="font-size: 0.8rem; line-height: 1;">GET IT ON</div>
                                <div style="font-size: 1.2rem; font-weight: bold;">Google Play</div>
                            </div>
                        </div>
                    </a>
                    
                    <!-- App Store Button -->
                    <a href="{{ $app_download['apple_store_link'] }}" target="_blank" class="btn btn-dark btn-lg d-block" 
                       style="border: 2px solid white; border-radius: 8px; padding: 15px 20px; text-decoration: none;">
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="mr-3">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M18.71 19.5C17.88 20.74 17 21.95 15.66 21.97C14.32 22 13.89 21.18 12.37 21.18C10.84 21.18 10.37 21.95 9.1 22C7.79 22.05 6.8 20.68 5.96 19.47C4.25 17 2.94 12.45 4.7 9.39C5.57 7.87 7.13 6.91 8.82 6.88C10.1 6.86 11.32 7.75 12.11 7.75C12.89 7.75 14.37 6.68 15.92 6.84C16.57 6.87 18.39 7.1 19.56 8.82C19.47 8.88 17.39 10.1 17.41 12.63C17.44 15.65 20.06 16.66 20.09 16.67C20.06 16.74 19.67 18.11 18.71 19.5ZM13 3.5C13.73 2.67 14.94 2.04 15.94 2C16.07 3.17 15.6 4.35 14.9 5.19C14.12 6.13 12.9 6.87 11.89 6.8C11.8 5.64 12.27 4.33 13 3.5Z" fill="white"/>
                                </svg>
                            </div>
                            <div class="text-left">
                                <div style="font-size: 0.8rem; line-height: 1;">Download on the</div>
                                <div style="font-size: 1.2rem; font-weight: bold;">App Store</div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.app-download-section {
    position: relative;
    overflow: hidden;
}

.app-download-section::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 200px;
    height: 200px;
    background: repeating-linear-gradient(
        45deg,
        rgba(255,255,255,0.1) 0px,
        rgba(255,255,255,0.1) 2px,
        transparent 2px,
        transparent 8px
    );
    pointer-events: none;
}

.app-download-buttons .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
}

@media (max-width: 768px) {
    .app-download-title {
        font-size: 2rem !important;
    }
    
    .app-download-description {
        font-size: 1rem !important;
    }
    
    .app-download-buttons .btn {
        padding: 12px 15px !important;
    }
}
</style>
