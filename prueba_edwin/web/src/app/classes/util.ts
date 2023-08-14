// import * as XLSX from 'xlsx';

const EXCEL_TYPE = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=UTF-8';
const EXCEL_EXTENSION = '.xlsx';
declare var $: any;
export class Util {

    public static removeAccents(str) {
        return str.normalize('NFD').replace(/[\u0300-\u036f]/g, "");
    }

    public static findString(str, str_compare) {
        if (!str) return false;
        return this.removeAccents(str.toLowerCase()).indexOf(Util.removeAccents(str_compare).toLowerCase()) > -1
    }

}