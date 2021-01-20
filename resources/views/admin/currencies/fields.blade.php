<!-- Title Field -->
<div class="form-group col-sm-12">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Code Field -->
<div class="form-group col-sm-12">
    {!! Form::label('code', 'Code:') !!}
    {!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>

<!-- Symbol Field -->
<div class="form-group col-sm-12">
    {!! Form::label('symbol', 'Symbol:') !!}
    {!! Form::text('symbol', null, ['class' => 'form-control']) !!}
</div>

<!-- Display Status Field -->
<div class="form-group col-sm-12">
    {!! Form::label('display_status', 'Display Status:') !!}
    {!! Form::select('display_status', ['1' => 'Active', '0' => 'Inactive'], null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.currencies.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
