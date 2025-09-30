<section class="category-section-one position-relative mt-120 lg-mt-80">
	<div class="container">
		<div class="row justify-content-between align-items-center">
			<div class="col-lg-8">
				<div class="title-three">
					<h2 class="fw-600 text-dark">{{__('Most Demanding Categories.')}}</h2>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="d-flex justify-content-lg-end">
					<a href="/jobs" class="btn-six d-none d-lg-inline-block">{{__('Explore all fields')}}</a>
				</div>
			</div>
		</div>
		<div class="card-wrapper row justify-content-center mt-45 lg-mt-30">
			@foreach($categories as $index => $category)
				<div class="card-style-one text-center mt-20 wow fadeInUp" data-wow-delay="0.{{ $index }}s">
					<a href="{{ url('/jobs/' . $category->cat_href) }}" class="wrapper {{ $loop->first ? 'active' : '' }}">
						<div class="icon d-flex align-items-center justify-content-center">
							<img src="{{ asset($category->cat_icon ?? 'site/images/icon/default_icon.svg') }}" alt="{{ $category->cat_name }}" class="lazy-img">
						</div>
						<div class="title fw-500">{{ __($category->cat_name) }}</div>
						{{-- <div class="total-job">{{ rand(6, 20) }}k+ Jobs</div> --}}
					</a>
				</div>
			@endforeach
		</div>		
		<!-- /.card-wrapper -->
		<div class="text-center mt-40 d-lg-none">
			<a href="/jobs" class="btn-six">Explore all fields</a>
		</div>
	</div>
</section>