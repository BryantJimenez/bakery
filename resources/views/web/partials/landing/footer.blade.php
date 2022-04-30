<footer class="bg-black">
	<div class="container">
		<div class="row">
			<div class="col-12 py-lg-5 px-5 pt-5">
				<div class="row justify-content-center">
					<div class="col-lg-3 col-md-6 col-sm-6 col-12 order-lg-1 order-2 text-center mb-sm-0 mb-3">
						<h5 class="text-white noto-serif font-weight-bold">@lang('web.home.footer.address.title')</h5>
						<p class="h6 text-white brandon-text mb-3">@lang('web.home.footer.address.text')</p>
						<a href="javascript:void(0);" class="btn btn-outline-dark brandon-text rounded px-3">@lang('web.home.footer.address.button')</a>
					</div>

					<div class="col-lg-6 col-md-9 col-12 order-lg-2 order-1 mb-lg-0 mb-4">
						<div class="card card-schedule">
							<div class="card-body py-lg-5 px-md-5 p-4">
								<h3 class="text-white text-center font-weight-bold noto-serif mb-md-3 mb-sm-2 mb-0">@lang('web.home.footer.schedule.title')</h3>
								@if($schedules->count()>0)
								@foreach($schedules as $schedule)
								<div class="border-bottom-dashed d-flex flex-column flex-sm-row justify-content-center justify-content-sm-between py-2">
									<p class="text-sm-left text-center brandon-text mb-0">
										{{ scheduleText($schedule->days) }}
									</p>
									<p class="text-sm-right text-center brandon-text mb-0">{{ $schedule->start->format('h:i a').' - '.$schedule->end->format('h:i a') }}</p>
								</div>
								@endforeach
								@else
								<p class="text-center brandon-text mb-0">@lang('web.home.footer.schedule.text.not found')</p>
								@endif
							</div>
						</div>
					</div>

					<div class="col-lg-3 col-md-6 col-sm-6 col-12 order-lg-3 order-3 text-center">
						<h5 class="text-white noto-serif font-weight-bold">@lang('web.home.footer.contact.title')</h5>
						<p class="h6 text-white brandon-text mb-0">@lang('web.home.footer.contact.phone')</p>
						<p class="h6 text-white brandon-text mb-3">@lang('web.home.footer.contact.email')</p>
						<a href="javascript:void(0);" class="btn btn-outline-dark brandon-text rounded px-3">@lang('web.home.footer.contact.button')</a>
					</div>
				</div>
			</div>
			<div class="col-12 py-4">
				<div class="row">
					<div class="col-12 d-flex justify-content-center">
						<div class="social-media d-flex justify-content-between">
							<a href="javascript:void(0);" target="_blank" class="d-flex justify-content-center align-items-center mx-1">
								<img src="{{ asset('web/img/landing/instagram-footer.svg') }}" width="18" height="18" title="Instagram" alt="Instagram">
							</a>

							<a href="javascript:void(0);" target="_blank" class="d-flex justify-content-center align-items-center mx-1">
								<img src="{{ asset('web/img/landing/facebook-footer.svg') }}" width="10" height="18" title="Facebook" alt="Facebook">
							</a>

							<a href="javascript:void(0);" target="_blank" class="d-flex justify-content-center align-items-center mx-1">
								<img src="{{ asset('web/img/landing/twitter-footer.svg') }}" width="18" height="15" title="Twitter" alt="Twitter">
							</a>

							<a href="javascript:void(0);" target="_blank" class="d-flex justify-content-center align-items-center mx-1">
								<img src="{{ asset('web/img/landing/pinterest-footer.svg') }}" width="13" height="16" title="Pinterest" alt="Pinterest">
							</a>

							<a href="javascript:void(0);" target="_blank" class="d-flex justify-content-center align-items-center mx-1">
								<img src="{{ asset('web/img/landing/youtube-footer.svg') }}" width="18" height="14" title="Youtube" alt="Youtube">
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 copyright py-3">
				<p class="text-center text-white noto-serif mb-0">@lang('web.home.footer.copyright')</p>
			</div>
		</div>
	</div>
</footer>