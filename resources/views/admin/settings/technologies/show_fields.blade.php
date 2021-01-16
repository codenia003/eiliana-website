<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $technology->id !!}</p>
    <hr>
</div>

<!-- Parent Id Field -->
<div class="form-group">
    {!! Form::label('parent_id', 'Parent Id:') !!}
    <p>{!! $technology->parent_id !!}</p>
    <hr>
</div>

<!-- Technology Name Field -->
<div class="form-group">
    {!! Form::label('technology_name', 'Technology Name:') !!}
    <p>{!! $technology->technology_name !!}</p>
    <hr>
</div>

<!-- Display Status Field -->
<div class="form-group">
    {!! Form::label('display_status', 'Display Status:') !!}
    <p>{!! $technology->display_status !!}</p>
    <hr>
</div>

