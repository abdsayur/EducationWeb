<div class="ac-category">
    <ul>
        <li><a class="{{ Request::is('student') ? 'active' : '' }}" href="{{ route('services.student') }}">Student</a>
        </li>
        <li><a class="{{ Request::is('professor') ? 'active' : '' }}"
                href="{{ route('services.professor') }}">Professor</a>
        </li>
        <li><a class="{{ Request::is('university') ? 'active' : '' }}"
                href="{{ route('services.university') }}">University</a>
        </li>
        <li><a class="{{ Request::is('company') ? 'active' : '' }}" href="{{ route('services.company') }}">Company</a>
        </li>
    </ul>
</div>
