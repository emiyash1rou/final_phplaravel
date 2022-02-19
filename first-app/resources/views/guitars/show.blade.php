@extends('header')
@section('title',"Guitars")
@section('content')
<div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
    <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
      <h1> Guitars Yarn</h1>
    </div>
<p> Viewing </p>
@if (count($guitars)>0)
    

<table>
    <tr>
        <th>Guitar</th>
        <th>brand</th>
        <th>Year Made</th>
        <th>Actions</th>
    </tr>
    <tr>
      <td> {{ $guitars['name'] }} </td>
      <td> {{ $guitars['brand'] }} </td>
      <td> {{ $guitars['year_made'] }} </td>
      <td><a href="{{ route('guitars.edit',['guitar' => $guitars['id'] ]) }}">Edit</a></td>
    </tr>
@else
<h1> No record currently</h1>
@endif  
</div>
<div>
    User Input: {{ strip_tags($userInput) }}
</div>
@endsection
