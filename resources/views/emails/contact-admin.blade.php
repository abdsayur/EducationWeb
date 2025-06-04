<p>New inquiry received:</p>
<ul>
    <li>Name: {{ $contact->first_name }} {{ $contact->last_name }}</li>
    <li>Email: {{ $contact->email }}</li>
    <li>Phone: {{ $contact->phone }}</li>
    <li>Type: {{ $contact->type }}</li>
    <li>Message: {{ $contact->description }}</li>
</ul>
