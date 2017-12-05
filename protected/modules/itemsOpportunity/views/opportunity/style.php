<style>
.pageContent {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    overflow-y: auto;
}
.tableContainer {
    backface-visibility: hidden;
    padding: 30px;
}
.tableView {
    clear: both;
}
table.list, table.stickyHeader {
    border-collapse: collapse;
    background: #fff;
    width: 100%; 
    font-size: 12px;
    line-height: 18px;
}
table.list th, table.stickyHeader th {
     /*border-left: 1px solid #c2c8cd; */
     /*background: linear-gradient(#fff, #f3f5f6);*/background-color: rgba(115, 149, 158, 0.80);
     color: #fff;
     border: 0 !important;
     font-weight: 600; 
     font-size: 14px; 
   /* border-bottom: 1px solid #c2c8cd;*/
    -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    cursor: pointer;
}
table.list td, table.list th, table.stickyHeader td, table.stickyHeader th {
/*    border-left: 1px solid #e0e4e7;*/
    padding: 6px 8px;
    vertical-align: middle;
    /*text-align: left;*/text-align: center;    
    overflow: hidden;
    text-overflow: ellipsis;
    -webkit-transition: background-color,0.15s;
    -moz-transition: background-color,0.15s;
    -ms-transition: background-color,0.15s;
    -o-transition: background-color,0.15s;
    transition: background-color,0.15s;
}
table.list td, table.stickyHeader td {
    line-height: 20px;
    font-size: 14px;
    /*border-top: 1px solid #e0e4e7;*/
    height: 20px;
}
.pageContent .emptyView {
    -webkit-box-shadow: 0 1px 3px #c2c8cd;
    -moz-box-shadow: 0 1px 3px #c2c8cd;
    box-shadow: 0 1px 3px #c2c8cd;
    border-top: 1px solid #e0e4e7;
}
.pageContent .emptyView .emptyList {
    padding: 100px 0px;
    background-color: #fff;
    text-align: center;
    position: relative;
    color: #26292c;
    font-size: 16px;
    line-height: 30px;
}
.pageContent .emptyView .emptyList .emptyMessage {
    position: relative;
}
table.list td[data-field] .item .editField, table.stickyHeader td[data-field] .item .editField {
    float: right;
    top: 50%;
    margin-top: -2px;
    display: inline-block;
    visibility: hidden;
    width: 20px;
    height: 20px;
    background-color: #fff;
    text-align: center;    
}
.button {
    display: inline-block;
    margin: 0;
    padding: 0;
    cursor: pointer;
    border: 0;
    background: transparent;
    font-weight: 600;
    font-family: 'OpenSans';
    font-size: 14px;
    line-height: 1.8em;
    text-decoration: none;
    text-align: center !important;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    -ms-box-sizing: border-box;
    -o-box-sizing: border-box;
    box-sizing: border-box;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
}
.button.small span, .button.small em, .chzn-container .chzn-results .button.small:active em {
    padding: 1px 7px;
    font-size: 12px;
    line-height: 20px;
}
.button span {
    color: rgba(38,41,44,0.64);
    background: #fff;
    border: 1px solid #c2c8cd;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
}
.button em, .button span {
    display: block;
    padding: 7px 16px;
    cursor: pointer;
    font-size: 14px;
    line-height: 16px;
}
.singleRow {
	display: inline-block;
}
.actions {
    margin: 0;
    padding: 8px 16px;
    text-align: right;
    border-top: 1px solid #e0e4e7;
    background-color: #f3f5f6;
    -webkit-border-radius: 0 0 3px 3px;
    -moz-border-radius: 0 0 3px 3px;
    border-radius: 0 0 3px 3px;
}
.deleteRow{
    text-align: center !important;
}


.table-deals>tbody {
    display:block;
    height:500px;
    overflow-y:auto;
}
.table-deals>tbody tr {
    background-color: #f1f5f6;    
    border-bottom: 2px solid #fff;
}
.table-deals>thead, .table-deals>tbody tr {    
    display:table;
    width:100%;
    table-layout:fixed;/* even columns width , fix width of table too*/
}
.table-deals>thead {
    width: calc( 100% - 1em )/ scrollbar is average 1em/16px width, remove it from thead width /
}
</style>