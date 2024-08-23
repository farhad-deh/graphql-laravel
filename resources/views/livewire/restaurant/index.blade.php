<div>
    <ul>
        @foreach($restaurants as $restaurant)
            <li>{{$restaurant->name . '/' . $restaurant->average_rating}}</li>
        @endforeach
    </ul>
</div>
