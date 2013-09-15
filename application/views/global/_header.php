<? $this->load->view('global/_page_open') ?>

<div class="contain-to-grid">
	<nav class="top-bar">
		<ul class="title-area">
			<li class="name">
				<h1>
					<a href="/">NameThis</a>
				</h1>
			</li>
		</ul>
	</nav>
</div>

<div class="row search-form">
	<div class="large-1 columns half-gutter">
		<label for="search-location" class="right inline">location</label>
    </div>

	<div class="large-5 columns half-gutter">
        <input type="text" name="location" id="search-location" placeholder="location" required>
    </div>

	<div class="large-1 columns half-gutter">
		<label for="search-date" class="right inline">date</label>
    </div>

	<div class="large-2 columns half-gutter">
        <input type="date" name="date" id="search-date" placeholder="mm/dd/yyyy" required>
    </div>

	<div class="large-3 columns half-gutter">
		<a href="#" class="small button search-button">search</a>
	</div>
</div>