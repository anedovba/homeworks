<form method="post">
    <div class="form-group">
        <label for="username">Name:</label>
        <input type='text' class="form-control" name='username' id="username" value='<?=post('username')?>'> <br><br>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type='email' class="form-control" name='email' id="email" value="<?=post('email')?>"> <br><br>
    </div>
    <div class="form-group">
        <label for="message">Message:</label>
        <textarea name='message' class="form-control-text" id='message'><?=post('message')?></textarea><br><br>
    </div>
    <div class="checkbox">
        <label>
            <label for='publish'>Publish email?</label>
            <input type='checkbox' id='publish' name='publish'>
        </label>
    </div>
    <button type="submit" class="btn btn-default" value="Go" name="button">Go</button>
</form>