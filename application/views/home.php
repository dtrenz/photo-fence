<? $this->load->view('global/_header') ?>

<div class="row">
    <div class="large-3 columns">
        <h3>Search</h3>

        <form id="search-form">
            <div class="row">
                <div class="large-12 columns">
                    <label>Start Date</label>
                    <input type="date" name="start_date" placeholder="mm/dd/yyyy" required>
                </div>
            </div>

            <div class="row">
                <div class="large-12 columns">
                    <label>Location</label>
                    <input type="text" name="location" placeholder="location" required>
                </div>
            </div>

            <a href="#" class="small button" id="search-button">search</a>
        </form>
    </div>

    <div class="large-9 columns">
        <h3>Results</h3>

        <? if ( ! empty($results) ) : ?>
            <? foreach ( $results as $result ) : ?>
                <img src="<?= $result->href ?>">
            <? endforeach; ?>
        <? endif; ?>
    </div>
</div>

<? $this->load->view('global/_footer') ?>