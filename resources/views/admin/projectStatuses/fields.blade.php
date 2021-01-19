<!-- Project Status Field -->
<div class="form-group col-sm-12">
    {!! Form::label('project_status', 'Project Status:') !!}
    {!! Form::text('project_status', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-center">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.projectStatuses.index') !!}" class="btn btn-secondary">Cancel</a>
</div>
