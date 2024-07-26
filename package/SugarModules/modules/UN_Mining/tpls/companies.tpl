<h2>{$MOD.LBL_TABLE_COMPANIES|upper}</h2>
<table class="table">
    <tr>
        <thead>
            <th scope="col">{$MOD.LBL_FIELD_COMPANY}</th>
            <th scope="col">{$MOD.LBL_FIELD_CONTRY}</th>
            <th scope="col">{$MOD.LBL_FIELD_MINED}</th>
        </tr>
    </thead>
    <tbody>
    {foreach from=$data key="idx" item="company"}
        <tr>
            <td>{$company.name}</td>
            <td>{$company.country_name}</td>
            <td>{$company.sum|format_tons} ({$company.target|format_tons})</td>
        </tr>
    {/foreach}
    </tbody>
</table>
