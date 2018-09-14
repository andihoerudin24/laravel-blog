<div class="card-body">
    <div class="form-group">
        <label for="title">Categories</label>
       {!! Form::text('title',null,['class'=>$errors->has('title') ? 'form-control is invalid' : 'form-control','required'=>'required','autofocus'=>'autofocus' ]) !!}
        @if ($errors->has('title'))
        <span class="invalid-feedback">
            <strong>{{$errors->first('title')}}</strong>
        </span>
       @endif
    </div>
</div>
<div class="card-footer bg-transparent">
    <button type="submit" class="btn btn-primary">
        Submit
    </button>
</div>