<form method="POST" action="{{ route('ads.store') }}">
    @csrf
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" required class="form-control" autofocus
        placeholder="Title of the Ad">

        @if($errors->has('title'))

        {!! $errors->first('title') !!} 

        @endif

    </div>

    <div class="form-group">

        <textarea  
        cols="50" 
        rows="5" 
        class="form-control" 
        id="description" 
        name="description" required
        >Default text here</textarea>
        @if($errors->has('description'))
        {!! $errors->first('description') !!} 
        @endif
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            <label for="publish">Publish</label>

            <div class="input-group date" id="publish" data-target-input="nearest">
                <input type="text" name="publish" required class="form-control datetimepicker-input"
                value="{{ date('m/d/Y h:i A')}}"
                data-target="#publish"/>
                <div class="input-group-append" data-target="#publish" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>

        </div>

        <div class="form-group col-md-6">
            <label for="expirespicker">Expires</label>

            <div class="input-group date" id="expirespicker" data-target-input="nearest">
                <input type="text" name="expires" required class="form-control datetimepicker-input"
                value="{{ Carbon\Carbon::now()->addDay()->format('m/d/Y h:i A') }}"

                data-target="#expirespicker"/>
                <div class="input-group-append" data-target="#expirespicker" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="form-group col-md-6">
            <label for="category">Category</label>
            <select class="form-control" name="category_id" id="category" required>
                <option value=""></option>
                @foreach($ad_categories as $cat)
                <option value="{{$cat->id }}" >{!! $cat->name !!}</option>
                @endforeach
            </select>

            @if($errors->has('category_id'))
            {!! $errors->first('category_id') !!} 
            @endif

        </div>

        <div class="form-group col-md-6">
            <label for="price">Price</label>
            <input type="text" id="price" class="form-control"
            name="price" required placeholder="Price of the Ad">
            @if($errors->has('price'))
            {!! $errors->first('price') !!} 
            @endif
        </div>
    </div>


    

    <div class="d-block">
        <input type="submit" value="Post" class="float-right btn btn-primary btn-lg">

    </div>
</form>