<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Town Field -->
<div class="form-group col-sm-12">
    {!! Form::label('town', 'Town:') !!}
    {!! Form::text('town', null, ['class' => 'form-control']) !!}
</div>

<!-- Display Status Field -->
<div class="form-group col-sm-12">
    {!! Form::label('display_status', 'Display Status:') !!}
    {!! Form::select('display_status', ['1' => 'Active', '0' => 'Inactive'], null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.universities.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
