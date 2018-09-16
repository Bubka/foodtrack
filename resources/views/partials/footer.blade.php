<style>
    .footer {
    /* position: absolute; */
        position: fixed;
        text-align: center;
        bottom: 0;
        width: 100%;
        height: 55px; /* Set the fixed height of the footer here */
        /*line-height: 120px;*/ /* Vertically center the text there */
        padding-top: 10px;
        background-color: #666;
    }
</style>

<footer class="footer" style="z-index: 100000">
    <div class="container">
        <a class="btn btn-dark col-xs-3" href="{{ route('intake.daily') }}">Daily</a>
        <a class="btn btn-dark col-xs-3" href="{{ route('food.index') }}">Foods</a>
        <a class="btn btn-dark col-xs-3" href="{{ route('intake.index') }}">Intakes</a>
        <a class="btn btn-dark col-xs-3" href="{{ route('recipe.index') }}">Recipes</a>
    </div>
</footer>