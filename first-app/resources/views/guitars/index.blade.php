@extends('header')
@section('title',"Guitars")
@section('content')
<div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
    <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
      <h1> Guitars Yarn</h1>
    </div>
<p> Hello, I'm Mer </p>
@if (count($guitars)>0)
    

<table>
    <tr>
        <th>Guitar</th>
        <th>brand</th>
        <th>View</th>
    </tr>


@foreach ($guitars as $guitar)

    <tr>
      <td> {{ $guitar['name'] }} </td>
      <td> {{ $guitar['brand'] }} </td>
     <td> <a href="{{ route('guitars.show',['guitar' => $guitar['id'] ]) }}">View Data</a> </td>
    </tr>

@endforeach
@else
<h1> No record currently</h1>
@endif  
</div>
<div>
    User Input: {{ strip_tags($userInput) }}
</div>
@endsection
