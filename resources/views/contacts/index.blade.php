@extends('layouts.app')

@section('content')
<div class="container">
    @if(session()->has('success'))  
        <div class="notification is-info is-light">
            <button class="delete"></button>
            {{ session()->get('success') }}
        </div>
    @endif
    <!-- Button trigger modal -->
    <button type="button" class="button is-primary" id="lanuchModal">
        Add Contact
    </button>
    <div class="level-right">
        <p class="control">
            <form action="{{ route('save-xml') }}" method="post" enctype="multipart/form-data">
                @csrf
                <p class="control">
                    <label for="file">Upload XML File for Contacts:</label>
                    <input type="file" class="form-control" name="file" required>
                </p>
                <p class="control">
                    <button type="submit" class="btn btn-primary" id="submit-post">Submit</button>
                </p>
                @error('file')
                    <div class="notification is-danger">
                        <button class="delete"></button>
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </form>
        </p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Phone</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $key => $contact)
                <tr>
                    <th scope="row">{{ $key + $contacts->firstItem() }}</th>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->lastname }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>
                        <span value="{{ $contact->id }}" class="editContact">
                            <i class="fa fa-pencil"></i>
                        </span>
                        |
                        <a href="{{ route('delete', ['id' => $contact->id]) }}" onclick="return confirm('Are you sure you want to delete this item?');" class="delete"></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $contacts->links() }}
</div>

<div id="modal" class="modal">
    <div class="modal-background"></div>
    <div class="modal-content">
        <header class="modal-card-head">
            <p class="modal-card-title">Add Contact</p>
            <button class="delete" aria-label="close"></button>
        </header>
        <div class="box">
            <form action="{{ route('CreateContact') }}" class="formModal" method="POST">
                @csrf
                <div class="field">
                    <label class="label">First Name</label>
                    <div class="control">
                        <input class="input name" type="text" name="name" placeholder="First Name" required>
                        <input class="input id" type="hidden" name="id">
                    </div>
                </div>
                <div class="field">
                    <label class="label">Last Name</label>
                    <div class="control">
                        <input class="input lastname" type="text" name="lastname" placeholder="Last Name" required>
                    </div>
                </div>
                <div class="field">
                    <label class="label">Phone</label>
                    <div class="control">
                        <input class="input phone" type="text" name="phone" placeholder="Phone" required>
                    </div>
                </div>
                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" class="button is-link">Submit</button>
                    </div>
                    <div class="control">
                        <button type="button" class="button is-link is-light cancel" aria-label="close">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <button class="modal-close is-large" aria-label="close"></button>
</div>

@endsection