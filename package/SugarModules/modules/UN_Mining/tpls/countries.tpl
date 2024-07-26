<h2>{$MOD.LBL_TABLE_COUNTRIES|upper}</h2>
<table class="table">
    <tr>
        <thead>
            <th scope="col">{$MOD.LBL_FIELD_CONTRY}</th>
            <th scope="col">{$MOD.LBL_FIELD_TARGET}</th>
            <th scope="col">{$MOD.LBL_FIELD_TOTAL}</th>
        </tr>
    </thead>
    <tbody>
    {foreach from=$data key="idx" item="country"}
        <tr>
            <td>{$country.name}</td>
            <td>{$country.target|format_tons}</td>
            <td>{$country.sum|format_tons}</td>
        </tr>
    {/foreach}
    </tbody>
</table>
