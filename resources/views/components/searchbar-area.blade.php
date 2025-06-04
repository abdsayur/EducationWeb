<div class="clgun offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop">
    <div class="offcanvas-header">
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('img/logo/logo.png') }}" alt="image">
        </a>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">
        <div class="search-box">
            <div class="searchwrapper">
                <div class="searchbox">
                    <div class="row align-items-center">
                        <div class="col-9 position-relative">
                            <input type="text" id="global-search-input" class="form-control"
                                placeholder="Find Your Course Here!">
                            <div id="global-search-results" class="list-group position-absolute w-100"
                                style="z-index: 9999; display: none;"></div>
                        </div>
                        {{-- <div class="col-lg-3">
                            <button type="button" id="global-search-btn" class="btn">Search</button>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>

        <div class="offcanvas-contact-info">
            <h4>Contact Info</h4>
            <ul class="contact-info list-style">
                @if($info?->phone)
                <li><i class="bx bxs-phone-call"></i> General Inquiries - <a href="tel:{{ $info->phone }}">{{
                        $info->phone }}</a></li>
                @endif
                @if($info?->email)
                <li><i class="bx bxs-envelope"></i> <a href="mailto:{{ $info->email }}">{{ $info->email }}</a></li>
                @endif
                @if($info?->location)
                <li><i class="bx bxs-map"></i>
                    <p>{{ $info->location }}</p>
                </li>
                @endif
            </ul>

            <ul class="social-profile list-style">
                @if($info?->facebook)
                <li><a href="{{ $info->facebook }}" target="_blank"><i class='bx bxl-facebook'></i></a></li>
                @endif
                @if($info?->instagram)
                <li><a href="{{ $info->instagram }}" target="_blank"><i class='bx bxl-instagram'></i></a></li>
                @endif
                @if($info?->linkedin)
                <li><a href="{{ $info->linkedin }}" target="_blank"><i class='bx bxl-linkedin'></i></a></li>
                @endif
                @if($info?->youtube)
                <li><a href="{{ $info->youtube }}" target="_blank"><i class='bx bxl-youtube'></i></a></li>
                @endif
            </ul>
        </div>
    </div>
</div>