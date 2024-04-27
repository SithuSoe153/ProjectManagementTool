<x-layout>


    <div class="container col-6 my-3">

        <form action="/project/store" method="POST" enctype="multipart/form-data" class="form-control">
            @csrf

            <div class="form-group">
                <label>Project Title</label>
                <input type="text" name="title" class="form-control" id="exampleInputEmail1"
                    aria-describedby="emailHelp" value="{{ old('title') }}">
            </div>
            @error('title')
                <p class="text-danger">{{ $message }}</p>
            @enderror

            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" class="form-control" id="start_date"
                    value="{{ old('start_date') }}">
            </div>
            @error('start_date')
                <p class="text-danger">{{ $message }}</p>
            @enderror

            <div class="form-group">
                <label for="due_date">Due Date</label>
                <input type="date" name="due_date" class="form-control" id="due_date" value="{{ old('due_date') }}">
            </div>
            @error('due_date')
                <p class="text-danger">{{ $message }}</p>
            @enderror


            {{-- <div class="form-group">
                <label>Blog Photo</label>
                <input type="file" name="photo" class="form-control" id="exampleInputPassword1">
            </div>
            @error('photo')
            <p class="text-danger">{{ $message }}</p>
            @enderror --}}
            {{-- <div class="form-group">
                <label>Blog Intro</label>
                <input type="text" name="intro" class="form-control" id="exampleInputPassword1">
            </div>
            @error('intro')
            <p class="text-danger">{{ $message }}</p>
            @enderror
            <div class="form-group">
                <label>Blog Body</label>
                <textarea class="form-control" name="body" id="" cols="30" rows="10">
                </textarea>
            </div>
            @error('body')
            <p class="text-danger">{{ $message }}</p>
            @enderror --}}

            <button type="submit" class="btn btn-primary my-2">Create Blog</button>
        </form>
    </div>
</x-layout>
