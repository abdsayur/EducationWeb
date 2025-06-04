<!-- Start theme and project Area -->
<div class="news-area ptb-100">
    <div class="container">
        <div class="section-title" data-aos="fade-up" data-aos-delay="100">
            <div class="sub-title">
                <i class='bx bxs-graduation'></i>
                <p>What We Have !?</p>
            </div>
            <h2 class="title-anim">Discover What Drives the Future
                High-Impact Projects and Future-Focused Themes to Accelerate Your Growth</h2>
        </div>

        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="news-content">
                    <ul>
                        @foreach ($projects as $project)
                        <li class="news-item" data-aos="fade-up" data-aos-delay="100">
                            <div class="image">
                                <img src="{{ Storage::disk('project-image')->url($project->image) }}" alt="image">
                            </div>
                            <div class="content title-anim">
                                <div class="sub-title">
                                    <i class='bx bxs-user'></i>
                                    <p>{{ $project->writer }} -- {{ optional($project->release_date)->format('M d, Y')
                                        ?? 'N/A' }}</p>
                                </div>
                                <h2 class="title-anim"><a
                                        href="{{ route('project.show', ['project' => $project->id]) }}">{{
                                        $project->title }}</a></h2>
                                <p>{{ \Str::limit(strip_tags($project->description), 100, '...') }}</p>
                                <a class="btn" href="{{ route('project.show', ['project' => $project->id]) }}">Continue
                                    Reading...</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="news-content-right" data-aos="fade-up" data-aos-delay="100">
                    <div class="content-box">
                        <img src="{{ Storage::disk('project-image')->url($themes[2]->image) }}" alt="iamge">
                        <div class="content title-anim">
                            <h3><a href="{{ route('theme.show', ['theme' => $themes[2]->id]) }}">{{
                                    $themes[2]->title
                                    }}</a></h3>
                            <p>{{ \Str::limit(strip_tags($themes[2]->description), 80, '...') }}</p>
                            <a class="btn" href="{{ route('theme.show', ['theme' => $themes[2]->id]) }}">Continue
                                Reading...</a>
                        </div>
                    </div>
                </div>
                <div class="news-content-item" data-aos="fade-up" data-aos-delay="200">
                    @foreach ($themes as $key=>$theme)
                    @if ($key != 2)
                    <div class="content-box">
                        <div class="image">
                            <img src="{{ Storage::disk('project-image')->url($theme->image) }}" alt="image">
                        </div>
                        <div class="content title-anim">
                            <div class="sub-title">
                                <i class='bx bxs-user'></i>
                                <p>{{ $theme->writer }}</p>
                            </div>
                            <h3><a href="{{ route('theme.show', ['theme' => $theme->id]) }}">{{ $theme->title }}</a>
                            </h3>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>

        <div class="section-btn text-center" data-aos="fade-zoom-in" data-aos-delay="100">
            <p>Where Dreams Take Flight. <a href="{{ route('project.index') }}">More Projects <i
                        class='bx bx-right-arrow-alt'></i></a></p>
        </div>
    </div>
</div>
<!-- End News Area -->
