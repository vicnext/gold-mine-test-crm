<script type='text/javascript' src='{sugar_getjspath file='modules/UN_Mining/leaders.js'}'></script>

<input type="button" name="Remove" value="Generate" onclick="generate()" class="button">
<label for="pet-select">Choose a month:</label>

<select name="month" id="month">
{foreach from=$data key="idx" item="month"}
  <option value="{$idx}">{$month}</option>
{/foreach}
</select>

<input type="button" name="Remove" value="Report" onclick="report()" class="button">

<div id="countries">
</div>

<div id="companies">
</div>
