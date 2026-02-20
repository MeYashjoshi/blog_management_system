@php
	$sidebarAuthor = $author ?? ($blog->author ?? null);
@endphp

@if ($sidebarAuthor)
	<div class="sidebar-widget_1_author-intro mt-40">
		<div class="sidebar-author-thumb text-center">
			<img class="round" src="{{ $sidebarAuthor->profile_url }}" alt="vexon" width="100" height="100" />
			<h4 class="mt-2">{{ $sidebarAuthor->full_name }}</h4>
			<div class="heading1">
				<p>{{ $sidebarAuthor->bio }}</p>
			</div>
			<div class="footer-social1">
				<a href="{{ route('author.page', $sidebarAuthor->id) }}" class="theme-btn1">View Profile</a>
			</div>
		</div>
	</div>
@endif