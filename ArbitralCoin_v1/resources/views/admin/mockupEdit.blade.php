@extends('layouts.adminPart')

@section('titolo')
ArbitralCoin
@endsection


@section('contenuto')
<form class="form-horizontal" name="book" method="post" action="{{ route('book.update', ['book' => $book->id]) }}">
@method('PUT')
@csrf

<input type="hidden" name="id" value="{{ $book->id }}"/>
            <label for="mySubmit" class="btn btn-primary"><i class="bi-check-lg"></i> Save</label>
            <input id="mySubmit" type="submit" value="Save" class="hidden" onclick="event.preventDefault(); checkBook('Save')"/>

            </form>
@endsection