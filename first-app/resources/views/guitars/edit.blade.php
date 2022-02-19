@extends('header')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
@section('title',"Create")
<style>
    form .form-error{
        font-size: .75rem;
        color: red;
        font-weight: bold;
    }

    </style>
@section('content')
<h1> Edit Guitar </h1>
<form method="POST" action={{ route('guitars.update',['guitar'=> $guitars['id']]) }}>
    @csrf
    @method('PUT')
    <div class="form-group">
      <label for="guitar-name">Name</label>
      <input type="text" class="form-control" id="guitar-name" value="{{ $guitars['name'] }}" name="guitar-name" aria-describedby="emailHelp" placeholder="Enter name">
      @error('guitar-name')
        <div class="form-error">
        {{ $message }}
        @enderror
    </div>
    <div class="form-group">
        <label for="brand">Brand</label>
        <input type="text" class="form-control" id="guitar_brand" name="brand"value="{{ $guitars['brand'] }}" aria-describedby="emailHelp" placeholder="Enter guitar brand">
        @error('brand')
        <div class="form-error">
        {{ $message }}
        @enderror
      </div>
      <div class="form-group">
        <label for="year-made">Year Made</label>
        <input type="text" class="form-control" id="year_made" name="year-made" value="{{ $guitars['year_made'] }}" aria-describedby="emailHelp" placeholder="Enter guitar year">
        @error('year-made')
        <div class="form-error">
        {{ $message }}
        @enderror
      </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
<div>
 
</div>
@endsection
