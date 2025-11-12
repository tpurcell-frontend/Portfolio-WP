<!-- wp:group {"className":"summary-section"} -->
<div class="wp-block-group summary-section">
    <!-- wp:group {"className":"container"} -->
    <div class="wp-block-group container">
        <!-- wp:group {"className":"row"} -->
        <div class="wp-block-group row">
            <!-- wp:group {"className":"col-12 col-md-8 slide-in"} -->
            <div class="wp-block-group col-12 col-md-8 slide-in">
                <!-- wp:heading {"level":2} -->
                <h2>Overview</h2>
                <!-- /wp:heading -->
                <!-- wp:paragraph -->
                <p>The React To-Do List Gutenberg Block is a dynamic WordPress block that adds an interactive to-do list to the front end of your site. It’s powered by React and seamlessly integrated into the Gutenberg editor using WordPress’s block APIs.</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
            <!-- wp:group {"className":"col-12 col-md-8 slide-in"} -->
            <div class="wp-block-group col-12 col-md-8 slide-in">
                <!-- wp:heading {"level":2} -->
                <h2>Editor Experience</h2>
                <!-- /wp:heading -->
                <!-- wp:paragraph -->
                <p>Inside the Gutenberg editor, the block appears as a simple placeholder labeled “To-Do List (renders on front-end).” This lightweight editor view keeps the editing interface clean while signaling that the real functionality happens when the block is rendered on the site.</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
            <!-- wp:group {"className":"col-12 col-md-8 slide-in"} -->
            <div class="wp-block-group col-12 col-md-8 slide-in">
                <!-- wp:heading {"level":2} -->
                <h2>Front-End Rendering</h2>
                <!-- /wp:heading -->
                <!-- wp:paragraph -->
                <p>When the block is displayed on the front end, WordPress uses a PHP render_callback to output a 'todo-list-root' id. This div serves as the mounting point for the React application. The plugin then enqueues the compiled React bundle, built using @wordpress/scripts, which attaches the React app to that div and initializes the to-do list interface.</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
            <!-- wp:group {"className":"col-12 col-md-8 slide-in"} -->
            <div class="wp-block-group col-12 col-md-8 slide-in">
                <!-- wp:heading {"level":2} -->
                <h2>React Functionality</h2>
                <!-- /wp:heading -->
                <!-- wp:paragraph -->
                <p>The React component (App) uses state hooks (useState) to manage the list of tasks. Users can add, toggle, and delete tasks interactively without reloading the page. The app also utilizes WordPress’s built-in React libraries—wp.element and wp.components—to ensure consistent styling and compatibility with the Gutenberg environment.</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
            <!-- wp:group {"className":"col-12 col-md-8 slide-in"} -->
            <div class="wp-block-group col-12 col-md-8 slide-in">
                <!-- wp:heading {"level":2} -->
                <h2>Technology Stack</h2>
                <!-- /wp:heading -->
                <!-- wp:paragraph -->
                <p>This block combines the power of React with WordPress’s native Gutenberg infrastructure, eliminating the need for external frameworks or complex build setups. The build process, handled by @wordpress/scripts, automatically compiles modern JSX code from src/ into a production-ready bundle in build/.</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->
