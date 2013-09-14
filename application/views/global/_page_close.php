        <? if ( ENVIRONMENT == 'development' ) : ?>
            <script data-main="/js/main" src="/js/vendor/require.js"></script>
        <? else : ?>
            <script src="/js/main.min.js"></script>
        <? endif; ?>
    </body>
</html>