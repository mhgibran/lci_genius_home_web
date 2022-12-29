@if (Session::has('flash_message'))
	<div class="alert  {{ Session::has('penting') ? 'alert-important alert-warning' : 'alert-success' }}">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		{{ Session::get('flash_message') }}
	</div>
@endif