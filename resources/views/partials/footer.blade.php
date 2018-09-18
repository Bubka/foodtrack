<style>
    footer {
        position: fixed;
        text-align: center;
        bottom: 0;
        width: 100%;
        background-color: #666;
        z-index: 100000
    }

    .appnav a {
      border-right: 1px solid #777;
      text-align: center;
      color: white;
      line-height: 60px;
      text-decoration: none;
    }

    .appnav a:last-child {
      border: none;
    }
</style>

<footer>
    <div class="container">
        <div class="row appnav">
            <a class="col-3" href="{{ route('intake.daily') }}">Daily</a>
            <a class="col-3" href="{{ route('food.index') }}">Foods</a>
            <a class="col-3" href="{{ route('intake.index') }}">Intakes</a>
            <a class="col-3" href="{{ route('recipe.index') }}">Recipes</a>
        </div>
    </div>
</footer>
