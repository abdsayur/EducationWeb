<!-- Start Offers Area -->
<div class="find-degree ptb-100">
    <div class="container">
        <div class="section-title text-center mb-5">
            <h2>Special Offers</h2>
            <p>Discover the latest offers tailored for you</p>
        </div>
        <div class="row g-4" data-aos="fade-up" data-aos-delay="100">
            @php
            function getIconClass($link) {
            if (str_ends_with($link, 'student')) return 'fa-user-graduate';
            if (str_ends_with($link, 'company')) return 'fa-building';
            if (str_ends_with($link, 'professor')) return 'fa-chalkboard-teacher';
            if (str_ends_with($link, 'university')) return 'fa-university';
            return 'fa-bullhorn'; // default
            }
            @endphp

            @foreach($offers as $index => $offer)
            <div class="col-lg-6 col-md-6 position-relative">
                <div class="offer-card p-4 rounded shadow-sm h-100 d-flex flex-column justify-content-between
                    {{ $index % 2 !== 0 ? 'offset-card' : '' }}">
                    <div>
                        <h4 class="offer-title mb-2">
                            <i class="fas {{ getIconClass($offer['link']) }} me-2 text-mainColor"></i>
                            {{ $offer['title'] }}
                        </h4>
                        <h6 class=" offer-slogan-color mb-2">{{ $offer['slogan'] }}</h6>
                        <div class="slogan-line mb-3"></div>
                        <p class="text-muted">
                            <span class="circle-icon me-2"><i class="fas fa-check"></i></span>
                            {{ $offer['description'] }}
                        </p>
                    </div>
                    <div class="text-end mt-4">
                        <a href="{{ $offer['link'] }}" class="btn btn-primary visit-btn">Visit</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .offers-area {
        background-color: #f9f9f9;
    }

    .offer-card {
        background: #fff;
        border: 1px solid #eee;
        transition: all 0.3s ease-in-out;
        position: relative;
        z-index: 1;
    }

    .offer-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
    }

    .offset-card {
        margin-top: 40px;
        background-color: #f4fef6;
        z-index: 2;
    }

    .offer-title {
        font-size: 1.5rem;
        font-weight: 600;
    }

    .offer-slogan-color {
        color: var(--mainColor);
    }

    .visit-btn {
        background-color: var(--mainColor);
        border: none;
        padding: 8px 20px;
        border-radius: 6px;
    }

    .visit-btn:hover {
        background-color: var(--blackColor);
    }

    @media (max-width: 767px) {
        .offset-card {
            margin-top: 0;
        }
    }

    .text-mainColor {
        color: var(--mainColor);
    }

    .slogan-line {
        width: 60px;
        height: 3px;
        background-color: var(--mainColor);
        border-radius: 2px;
        margin-top: 5px;
        margin-bottom: 10px;
    }

    .circle-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 22px;
        height: 22px;
        background-color: var(--mainColor);
        color: #fff;
        border-radius: 50%;
        font-size: 12px;
    }

    .offer-card:hover .slogan-line {
        width: 120px;
        transition: all 0.3s ease-in-out;
    }
</style>
<!-- End Offers Area -->
