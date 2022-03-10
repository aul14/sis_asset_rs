<template>
<div class="p-1 border-top-1 border-light table-responsive">
    <label class="form-title" samrs-typography="700">{{ listAlphabet }}. {{titleKpi}} kpi point & service fee</label>
    <div class="border-1 border-dark table-responsive">
        <table class="table samrs-tableview capitalize mb-0">
            <tbody>
                <tr>
                    <td>
                        KPI Point
                    </td>
                    <td>
                        <input class="form-control w-100" type="text" onkeypress="return hanyaAngka(event)" name="kpi_point">
                    </td>
                </tr>
                <tr>
                    <td>
                        Service Fee
                    </td>
                    <td>
                        <input class="form-control w-100" type="text" onkeypress="return hanyaAngka(event)" name="service_price">
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</template>

<script>
module.exports = {
    props: {
        listAlphabet: {
            type: String,
            default: 'List_Unavailable',
        },
        titleKpi: {
            type: String,
            default: 'Title_Unavailable',
        }
    }
}
</script>
