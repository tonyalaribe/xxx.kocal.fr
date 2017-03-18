@foreach($videos as $video)
    <tr>
        <td>{{$video->id}}</td>
        <td><a href="{{$video->url}}">{{$video->title}}</a></td>
        <td><a href="{{$video->site->url}}">{{$video->site->name}}</a></td>
        <td>
            <span class="thumbnail">
                <img style="height: 100px" src="{{$video->thumbnail_url}}">
            </span>
        </td>
        <td>
            <button class="btn btn-danger">Delete</button>
        </td>
    </tr>
@endforeach