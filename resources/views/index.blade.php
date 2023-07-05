<!DOCTYPE html>
<html>
<head>
    <title>Link Shortener</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<h1>Link Shortener</h1>

<form id="shorten-form">
    @csrf
    <input type="text" name="link" placeholder="Enter the link">
    <button type="submit">Shorten</button>
</form>

<h2>Recent Links:</h2>
<ul id="recent-links">
    @foreach($recentLinks as $link)
        <li>{{ $link->shortened_link }}</li>
    @endforeach
</ul>

<script>
    $(document).ready(function() {
        $('#shorten-form').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
                type: 'POST',
                url: '{{ route("shorten") }}',
                data: form.serialize(),
                success: function(response) {
                    $('#recent-links').prepend('<li>' + response.shortenedLink + '</li>');
                    form.trigger('reset');
                }
            });
        });

        setInterval(function() {
            $.ajax({
                type: 'GET',
                url: '{{ route("recent_links") }}',
                success: function(response) {
                    var recentLinks = response.recentLinks;
                    var linksList = '';
                    for (var i = 0; i < recentLinks.length; i++) {
                        linksList += '<li>' + recentLinks[i].shortened_link + '</li>';
                    }
                    $('#recent-links').html(linksList);
                }
            });
        }, 5000);
    });
</script>
</body>
</html>
