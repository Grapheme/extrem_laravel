
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="margin-bottom-25 margin-top-10 ">
				<a class="btn btn-primary" href="?view=unapproved"><? if($view != 1){ echo '<i class="fa fa-check"></i> '; } ?>Ожидают одобрения</a>
				<a class="btn btn-primary" href="?view=approved"><? if($view == 1){ echo '<i class="fa fa-check"></i> '; } ?>Одобренные ранее</a>
			</div>
		</div>
	</div>
