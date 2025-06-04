@extends('layouts.app1')
<style>
    .select2-container--default .select2-selection--single {
        border: 1px solid #ced4da;
        border-radius: 0.25rem;
        padding: 0.375rem 0.75rem;
        height: auto;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 100%;
    }

    #global-search-results {
        max-height: 300px;
        overflow-y: auto;
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        margin-top: 5px;
        z-index: 9999;
    }

    #global-search-results a {
        display: block;
        padding: 0.75rem 1rem;
        border-bottom: 1px solid #f1f1f1;
        color: var(--mainColor);
        text-decoration: none;
    }

    #global-search-results a:hover {
        background-color: #f2f8f2;
    }

    #global-search-results .search-type {
        font-size: 0.75rem;
        margin-right: 0.5rem;
        padding: 0.25rem 0.5rem;
        border-radius: 0.2rem;
    }

    /* #global-search-results small {
        font-size: 0.75rem;
        color: #6c757d;
    } */

    .Course {
        background-color: #cce5ff;
        color: #004085;
    }

    .Project {
        background-color: #d4edda;
        color: #155724;
    }

    .Theme {
        background-color: #fff3cd;
        color: #856404;
    }

    .Service {
        background-color: var(--mainColor);
        color: #721c24;
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@section('title', 'Home Page')

@section('content')

<!-- Start Clgun Searchbar Area -->
@include('components.searchbar-area', ['info' => $info])
<!-- End Clgun Searchbar Area -->

<!-- Start Clgun Slider Banner Area -->
@include('components.slider-banner-area', ['sliders' => $homeSliders])
<!-- End Clgun Slider Banner Area -->

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<!-- Start Find Degree Area -->
@include('components.degree-area', ['banner' => $banner])
<!-- End Find Degree Area -->

@include('components.offers-area', ['offers' => $offers])

@include('components.theme-and-project-area')

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        // Initialize Select2 on the dropdowns
        $('#searchKey10').select2({
            placeholder: "Select a domain...", // Placeholder text
            allowClear: true, // Allow clearing the selection
        });

        $('#searchKey11').select2({
            placeholder: "Select a title...", // Placeholder text
            allowClear: true, // Allow clearing the selection
        });
    });
</script>
<script>
    $(document).ready(function () {
    let timer;

    function performSearch(query) {
        if (query.length > 1) {
            $.ajax({
                url: '{{ route("global.live-search") }}',
                type: 'POST',
                data: {
                    q: query,
                    _token: '{{ csrf_token() }}' // CSRF token
                },
                success: function (data) {
                    let resultBox = $('#global-search-results');
                    resultBox.empty();

                    if (data.length) {
                        data.forEach(function (item) {
                            resultBox.append(
                            `<a href="${item.link}" class="list-group-item list-group-item-action">
                                <div class="d-flex align-items-center mb-1">
                                    <span class="search-type ${item.type.replace(/\s/g, '')}">${item.type}</span>
                                    <div class="ms-2 fw-bold">${item.title}</div>
                                </div>
                                ${item.snippet ? `<small class="text-muted d-block ms-4">${item.snippet}</small>` : ''}
                            </a>`
                            );
                        });
                    } else {
                    resultBox.append(`<div class="list-group-item text-muted">No results found.</div>`);
                    }

                    resultBox.show();
                },
                error: function(xhr, status, error) {
                    console.error('Error:', status, error);
                    alert('An error occurred: ' + error);
                }
            });


        } else {
            $('#global-search-results').hide();
        }
    }

    // Keyup with debounce
    $('#global-search-input').on('keyup', function (e) {
        clearTimeout(timer);
        let query = $(this).val();

        timer = setTimeout(function () {
            performSearch(query);
        }, 300);

        // Enter key triggers search immediately
        if (e.key === 'Enter') {
            clearTimeout(timer);
            performSearch(query);
        }
    });

    // Button click
    $('#global-search-btn').on('click', function () {
        let query = $('#global-search-input').val();
        performSearch(query);
    });

    // Click outside closes results
    $(document).click(function (e) {
        if (!$(e.target).closest('#global-search-input, #global-search-results, #global-search-btn').length) {
            $('#global-search-results').hide();
        }
    });
});
</script>

@endsection
