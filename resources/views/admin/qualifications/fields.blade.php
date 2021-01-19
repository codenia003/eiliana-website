<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-sm-12">
    {!! Form::label('type', 'Type:') !!}
    {!! Form::select('type', ['UG' => 'UG', 'PG' => 'PG'], null, ['class' => 'form-control']) !!}
</div>

<!-- Display Status Field -->
<div class="form-group col-sm-12">
    {!! Form::label('display_status', 'Display Status:') !!}
    {!! Form::select('display_status', ['1' => 'Active', '0' => 'Inactive'], null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.qualifications.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
