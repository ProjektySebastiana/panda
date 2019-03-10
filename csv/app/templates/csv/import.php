<form method="POST" action="csv-import.php">
    <h2>Import CSV to Database</h2>
    <p>select prepared file:</p>
    <div class="radio-3">
        <input type="radio" name="file" id="country25" value="country25"/>
        <label class="form-control" for="country25">country 25 rows</label>
        <input type="radio" name="file" id="country100" value="country100"/>
        <label class="form-control" for="country100">country 100 rows</label>
        <input type="radio" name="file" id="country1000" value="country1000"/>
        <label class="form-control" for="country1000">country 1000 rows</label>
    </div>
    <p>and generate chart depends on:</p>
    <input name="column" type="text" placeholder="Column name" value="country" class="form-control"/>
    <div class="buttons">
        <button type="submit" class="btn btn-success">Submit</button>
    </div>
</form>