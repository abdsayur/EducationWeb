<div class="find-degree ptb-100">
    <div class="container">
        <div class="d-row">
            <div class="d-col-1">
                <div class="content-1" data-aos="fade-up" data-aos-delay="100">
                    <form id="searchForm" method="GET">
                        <h4>Find Project or Theme</h4>
                        <p>Choose a type and filter by domain or title to find what suits you</p>

                        <div class="selector-box">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="radioProject"
                                    value="project" checked>
                                <label class="form-check-label" for="radioProject">Project</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="type" id="radioTheme" value="theme">
                                <label class="form-check-label" for="radioTheme">Theme</label>
                            </div>
                        </div>

                        <div class="search-key">
                            <label for="domainSelect">Search by Domain</label>
                            <select class="form-select" name="domain" id="domainSelect">
                                <!-- domains will be loaded dynamically -->
                            </select>

                            <label for="titleSelect">Search by Title</label>
                            <select class="form-select" name="title" id="titleSelect">
                                <!-- titles will be loaded dynamically -->
                            </select>
                        </div>

                        <div class="selector-btns">
                            <button type="submit" class="default-btn">Submit</button>
                            <button type="reset" class="default-btn black">Reset</button>
                        </div>
                        <p>Find More <a class="btn" href="/project"> Projects</a> <span>Or</span> <a class="btn"
                                href="/theme">Themes</a>
                    </form>
                </div>
            </div>
            <div class="d-col-2">
                <div class="content-image"
                    style="background-image: url('{{ Storage::disk('banner-section-image')->url($banner->home_image) }}');">
                    <div class="content" data-aos="fade-down" data-aos-delay="100">
                        <h5>{{ $banner->home_text_1 }}</h5>
                        <h3>{{ $banner->home_text_2 }}</h3>
                        <h4>{{ $banner->home_text_3 }}</h4>
                        {{-- <a class="btn" href="#">JOIN INTAKE</a> --}}
                    </div>
                </div>
            </div>
            <div class="d-col-3">
                <div class="content-1" data-aos="fade-up" data-aos-delay="100">
                    <form id="searchCourseForm" method="GET">
                        <h4>Find Course</h4>

                        <div class="selector-box">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="call_type" id="exampleRadios1"
                                    value="face-to-face">
                                <label class="form-check-label" for="exampleRadios1">Face To Face</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="call_type" id="exampleRadios2"
                                    value="online">
                                <label class="form-check-label" for="exampleRadios2">Online</label>
                            </div>
                        </div>

                        <div class="search-key">
                            <label for="searchTag">Search by Tags</label>
                            <select class="form-select" id="searchTag" name="tag">
                                <option selected disabled>Select one...</option>
                                @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">{{ strtoupper($tag->name) }}</option>
                                @endforeach
                            </select>

                            <label for="searchLanguage">Search by Language</label>
                            <select class="form-select" id="searchLanguage" name="language">
                                <option selected disabled>Select one...</option>
                                <option value="french">French</option>
                                <option value="english">English</option>
                            </select>

                            <label for="searchTitle">Search by Title</label>
                            <select class="form-select" id="searchTitle" name="title">
                                <option selected disabled>Select one...</option>
                                @foreach($courseTitles as $title)
                                <option value="{{ $title }}">{{ $title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="selector-btns">
                            <button type="submit" class="default-btn">Submit</button>
                            <button type="reset" class="default-btn black">Reset</button>
                        </div>

                        <a class="btn" href="/course">Discover More Courses..</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('searchForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission

        // Get the selected type (Project or Theme)
        const selectedType = document.querySelector('input[name="type"]:checked').value;

        // Get the selected domain and title
        const domain = document.querySelector('select[name="domain"]').value;
        const title = document.querySelector('select[name="title"]').value;

        // Construct the URL based on the selected type
        let url = `/${selectedType}?`;

        // Add query parameters if they are selected
        if (domain !== 'Select one...') {
            url += `domain=${domain}&`;
        }
        if (title !== 'Select one...') {
            url += `title=${title}&`;
        }

        // Remove the trailing '&' or '?' if no parameters are added
        url = url.replace(/[&?]$/, '');

        // Redirect to the constructed URL
        window.location.href = url;
    });
</script>
<script>
    document.getElementById('searchCourseForm').addEventListener('submit', function (event) {
        event.preventDefault();

        const callType = document.querySelector('input[name="call_type"]:checked')?.value;
        const tag = document.getElementById('searchTag').value;
        const language = document.getElementById('searchLanguage').value;
        const title = document.getElementById('searchTitle').value;

        const params = new URLSearchParams();

        if (callType && callType !== 'Select one...') params.append('location', callType);
        if (tag && tag !== 'Select one...') params.append('tag', tag);
        if (language && language !== 'Select one...') params.append('language', language);
        if (title && title !== 'Select one...') params.append('search', title);  // using search for title

        const url = `/course?${params.toString()}`;
        window.location.href = url;
    });
</script>
<script>
    const projectTitles = @json($projectTitles);
    const themeTitles = @json($themeTitles);
    const projectDomains = @json($projectDomains);
    const themeDomains = @json($themeDomains);

    function updateSelectOptions(selectId, optionsArray) {
        const select = document.getElementById(selectId);
        select.innerHTML = '<option selected disabled>Select one...</option>';

        optionsArray.forEach(item => {
            const option = document.createElement('option');
            option.value = item;
            option.textContent = item;
            select.appendChild(option);
        });
    }

    function updateFormOptions(type) {
        const titles = type === 'project' ? projectTitles : themeTitles;
        const domains = type === 'project' ? projectDomains : themeDomains;

        updateSelectOptions('titleSelect', titles);
        updateSelectOptions('domainSelect', domains);
    }

    // On page load
    updateFormOptions('project');

    // Listen for type change
    document.querySelectorAll('input[name="type"]').forEach(radio => {
        radio.addEventListener('change', function () {
            updateFormOptions(this.value);
        });
    });
</script>
