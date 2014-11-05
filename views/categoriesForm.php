<div style="display: none;" id="new-category">
    <a href="javascript:none();" class="declineButton" id="closeNewCategory"><?php echo $btn['close']; ?></a>&nbsp;
    <a href="javascript:none();" class="primaryButton" id="saveNewCategory"><?php echo $btn['save']; ?></a>&nbsp;
    <a href="javascript:none();" class="primaryButton" id="createCategory"><?php echo $btn['create']; ?></a>&nbsp;
    <a href="javascript:none();" class="declineButton" id="deleteCategory"><?php echo $btn['delete']; ?></a>&nbsp;
    <a href="javascript:none();" class="primaryButton" id="activateCategory"><?php echo $btn['activate']; ?></a>&nbsp;
    <div>
        <input hidden type="text" id="category-id" class="text-box single-line" value="">
        <div>
            <div class="editor-label">
                <?php echo $category['name']; ?>
            </div>
            <input type="text" required id="category-name" class="text-box single-line" value="">
        </div>

        <div class="category-icon">
            <div class="addiconContainer" data-id="0">
                <div class="addicon filebox"></div>
            </div>
        </div>
    </div>
</div>

<div style="display: none;" id="help-dialog">
    <p><i>Line.</i> For line graph must be define column with name 'x'(for xAxis). 
        Other column must have numbers type of data.</p>
    <p><i>Bar.</i> For bar graph must be define column with name 'x'(for xAxis). 
        Other column must have numbers type of data.</p>
    <p><i>Pie.</i> For pie graph must be define column with name 'x' with names for each data line and column 'val' with numeric data. 
        Other column must have numbers type of data.</p>
    <p><i>Filter.</i> Filter fields must be define in scobes like '{var}', where 'var' is a filter name.
        The value for this variable will be selected by a user from predefined list of values.</p>
    <p><i>Example(line, bar).</i> SELECT field1 AS x, field2, field3 FROM table1 WHERE id={var1}</p>
    <p><i>Example(pie).</i> SELECT field1 AS x, field2 AS val</p>
</div>

<div style="display: none;" id="filter-help">
    <p><i>Filter.</i> Filter fields must be define in scobes like '{var}' of your sql string, where 'var' is a filter name.
        The value for this variable will be selected by a user from predefined list of values.</p>
    <p>Each filter has two names: "name" - will be displayed for user, "variable name" - used for sql statement.</p>
    <p>If variable has type date - user will see date spinner for selecting date</p>
    <p>If variable has type string - you must predefine list of possible items:</p>
    <p>Each item has name and value: "name" - will be displayed for user, "value" - used for sql statement</p>
    <p><i>Example</i> SELECT field1 AS x, field2, field3 FROM table1 WHERE id={var1} AND date = {var2}</p>
    <p>'var1' you defined like string and created list of possible values:</p>
    <p>"Shop1" with value "1" and "Shop2" with value "2"</p>
    <p>'var2' you defined like a date</p>
    <p>In this case user will see two filters in the mobile app:</p>
    <p>One is predefined list: "Shop1", "Shop2"; and date select</p>
    <p>If user choosed "Shop1" and date "2014-05-01" sql will look like:</p>
    <p>SELECT field1 AS x, field2, field3 FROM table1 WHERE id=1 AND date = 2014-05-01</p>
</div>

<div class="right-block-content">
    <p>
        <a href="javascript:none();" class="primaryButton" id="createNewCategory"><?php echo $category['createNewCategory']; ?></a>&nbsp;
        <a href="javascript:none();" class="primaryButton" id="editCategory"><?php echo $category['editCategory']; ?></a>&nbsp;
        <a href="javascript:none();" class="primaryButton" id="createNewGraph"><?php echo $category['createNewGraph']; ?></a>&nbsp;
    </p>

    <div class="content-page-left">
        <ol id="categories-list" class="sortable ui-sortable">
            <?php
            // var_dump(CategoryPage::$categories); 
            echo CategoryPage::$categoriesLayout;
            ?>
        </ol>
    </div>

    <div class="content-page-right">
        <div id="variables-window">
            <div id="filter-form">
                <a href="javascript:none();" class="declineButton" id="closeFilterForm"><?php echo $btn['close']; ?></a>&nbsp;
                <a href="javascript:none();" class="primaryButton" id="saveNewFilter"><?php echo $btn['save']; ?></a>&nbsp;
                <a href="javascript:none();" class="primaryButton" id="updateFilter"><?php echo $btn['update']; ?></a>&nbsp;
                <a href="javascript:none();" class="primaryButton" id="activateFilter"><?php echo $btn['activate']; ?></a>&nbsp;
                <a href="javascript:none();" class="declineButton" id="deleteFilter"><?php echo $btn['delete']; ?></a>&nbsp;
                <div>
                    <div>
                        <label for="filter-name"><?php echo $category['filterName']; ?></label>
                        <input type="text" required name="filter-name" id="filter-name">
                    </div>

                    <div>
                        <label for="var-name"><?php echo $category['varName']; ?></label>
                        <input type="text" required name="var-name" id="var-name">
                    </div>
                    
                    <div>
                        <label for="var-type"><?php echo $category['varType']; ?></label>
                        <select name="var-type" id="var-type">
                            <option value="4">String</option>
                            <option value="2">Date</option>
                        </select>
                    </div>


                </div>
            </div>
            
            <div id="item-form">
                <a href="javascript:none();" class="declineButton" id="closeItemForm"><?php echo $btn['close']; ?></a>&nbsp;
                <a href="javascript:none();" class="primaryButton" id="saveNewItem"><?php echo $btn['save']; ?></a>&nbsp;
                <a href="javascript:none();" class="primaryButton" id="updateItem"><?php echo $btn['update']; ?></a>&nbsp;
                <a href="javascript:none();" class="primaryButton" id="activateItem"><?php echo $btn['activate']; ?></a>&nbsp;
                <a href="javascript:none();" class="declineButton" id="deleteItem"><?php echo $btn['delete']; ?></a>&nbsp;
                <div>
                    <div>
                        <label for="display-value"><?php echo $category['name']; ?></label>
                        <input type="text" required name="display-value" id="display-value">
                    </div>

                    <div>
                        <label for="list-value"><?php echo $category['value']; ?></label>
                        <input type="text" required name="list-value" id="list-value">
                    </div>
                </div>
            </div>
            
            <a href="javascript:none();" class="primaryButton" id="addVariable"><?php echo $category['addFilter']; ?></a>&nbsp;
            <a href="javascript:none();" class="primaryButton" id="editVariable"><?php echo $btn['edit']; ?></a>&nbsp;
            <a href="javascript:none();" class="primaryButton" id="editItem"><?php echo $btn['edit']; ?></a>&nbsp;
            <a href="javascript:none();" class="primaryButton" id="addItem"><?php echo $category['addItem']; ?></a>&nbsp;

            <ol id="variables-list" class="sortable ui-sortable">
                
            </ol>

        </div>
        
        
        
        
        <div id="graphForm">
            <form method="post" action="#"> 
                <div class="form-buttons">
                    <a href="javascript:none();" class="primaryButton" id="btnPreview"><?php echo $category['preview']; ?></a>&nbsp;
                    
                    <a href="javascript:none();" class="primaryButton" id="btnGraphActivate"><?php echo $btn['activate']; ?></a>&nbsp;
                    <a href="javascript:none();" class="declineButton" id="btnGraphDelete"><?php echo $btn['delete']; ?></a>&nbsp;
                    <a href="javascript:none();" class="primaryButton" id="btnGraphSave"><?php echo $btn['save']; ?></a>&nbsp;
                    <a href="javascript:none();" class="primaryButton" id="btnGraphCreate"><?php echo $btn['create']; ?></a>&nbsp;
                    <a href="javascript:none();" class="primaryButton" id="btnGraphVariables"><?php echo $category['filters']; ?></a>&nbsp; 
                    <a href="javascript:none();" class="primaryButton" id="btnGraphFields"><?php echo $category['fields']; ?></a>&nbsp;

                </div>

                <div id="graph-form" class="form-main">
                    <input type="number" hidden name="id" id="id">
                    <input type="number" hidden name="image" id="image">
                    <input type="number" hidden name="comp_id" id="comp_id" value="<?php echo Main::$user->id; ?>">
                    <input type="number" hidden name="graph_group_id" id="graph_group_id">
                    <fieldset>
                        <table style="width: 100%;">
                            <tbody>
                                <tr>
                                    <td><?php echo $graph['reportName']; ?></td>
                                    <td>
                                        <input type="text" class="input" name="graph_name" id="graph_name">
                                    </td>
                                    <td><?php echo $graph['graphType']; ?></td>
                                    <td>
                                        <select name="type" id="type">
                                            <option value="1">line</option>
                                            <option value="2">bar</option>
                                            <option value="3">pie</option>			
                                        </select>
                                    </td>
                                    
                                </tr>
                                <tr>
                                    <td><?php echo $graph['sqlCommand']; ?>
                                        <span class="sql-help"><img src="img/info.png" width="18" height="18" /></span></td>
                                    <td colspan="3">
                                        <textarea rows="7" type="text" id="sql_command"></textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $graph['dbName']; ?></td>
                                    <td><input type="text" value="" name="table_name" id="table_name"></td>
                                    <td>Logo</td>
                                    <td>
                                        <div class="graph-icon">
                                            <div class="addiconContainer" data-id="0">
                                                <div class="addicon filebox"></div>
                                            </div>
                                        </div>
                                        <input type="text" id="logo_path" hidden>
                                    </td>

                                </tr>
                                
                                <tr>
                                    <td><?php echo $graph['backgroundColor']; ?></td>
                                    <td><input type="color" value="" name="background_color" id="background_color"></td>
                                    <td><?php echo $graph['borderColor']; ?></td>
                                    <td><input type="color" value="" name="border_color" id="border_color"></td>
                                </tr>
                                <tr>
                                    <td><?php echo $graph['borderRadius']; ?></td>
                                    <td><input type="number" value="" name="border_radius" id="border_radius"></td>
                                    <td><?php echo $graph['borderWidth']; ?></td>
                                    <td><input type="number" value="" name="border_width" id="border_width"></td>
                                </tr>
                                <tr>
                                    <td><?php echo $graph['marginBottom']; ?></td>
                                    <td><input type="number" value="" name="margin_bottom" id="margin_bottom"></td>
                                    <td><?php echo $graph['marginLeft']; ?></td>
                                    <td><input type="number" value="" name="margin_left" id="margin_left"></td>
                                </tr>
                                <tr>
                                    <td><?php echo $graph['marginRight']; ?></td>
                                    <td><input type="number" value="" name="margin_right" id="margin_right"></td>
                                    <td><?php echo $graph['marginTop']; ?></td>
                                    <td><input type="number" value="" name="margin_top" id="margin_top"></td>
                                </tr>
                                <tr>
                                    <td><?php echo $graph['plotBackgroundColor']; ?></td>
                                    <td><input type="color" value="" name="plot_background_color" id="plot_background_color"></td>
                                    <td><?php echo $graph['plotBorderColor']; ?></td>
                                    <td><input type="color" value="" name="plot_border_color" id="plot_border_color"></td>
                                </tr>
                                <tr>
                                    <td><?php echo $graph['plotBorderWidth']; ?></td>
                                    <td><input type="number" value="" name="plot_border_width" id="plot_border_width"></td>
                                    <td><?php echo $graph['showAxes']; ?></td>
                                    <td>
                                        <select name="show_axes" id="show_axes">
                                            <option value="0"><?php echo $global['no']; ?></option>
                                            <option value="1"><?php echo $global['yes']; ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $graph['spacingBottom']; ?></td>
                                    <td><input type="number" value="" name="spacing_bottom" id="spacing_bottom"></td>
                                    <td><?php echo $graph['spacingLeft']; ?></td>
                                    <td><input type="number" value="" name="spacing_left" id="spacing_left"></td>
                                </tr>
                                <tr>
                                    <td><?php echo $graph['spacingRight']; ?></td>
                                    <td><input type="number" value="" name="spacing_right" id="spacing_right"></td>
                                    <td><?php echo $graph['spacingTop']; ?></td>
                                    <td><input type="number" value="" name="spacing_top" id="spacing_top"></td>
                                </tr>
                                <tr>
                                    <td><?php echo $graph['legendAlign']; ?></td>
                                    <td>
                                        <select name="legend_align" id="legend_align">
                                            <option value="center"><?php echo $graph['center']; ?></option>
                                            <option value="left"><?php echo $graph['left']; ?></option>
                                            <option value="right"><?php echo $graph['right']; ?></option>
                                        </select>
                                    </td>
                                    <td><?php echo $graph['legendBackgroundColor']; ?></td>
                                    <td><input type="color" value="" name="legend_background_color" id="legend_background_color"></td>
                                </tr>
                                <tr>
                                    <td><?php echo $graph['legendBorderColor']; ?></td>
                                    <td><input type="color" value="" name="legend_border_color" id="legend_border_color"></td>
                                    <td><?php echo $graph['legendBorderRadius']; ?></td>
                                    <td><input type="number" value="" name="legend_border_radius" id="legend_border_radius"></td>
                                </tr>
                                <tr>
                                    <td><?php echo $graph['legendBorderWidth']; ?></td>
                                    <td><input type="number" value="" name="legend_border_width" id="legend_border_width"></td>
                                    <td><?php echo $graph['legendEnabled']; ?></td>
                                    <td>
                                        <select name="legend_enabled" id="legend_enabled">
                                            <option value="1"><?php echo $global['yes']; ?></option>
                                            <option value="0"><?php echo $global['no']; ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $graph['legendFloating']; ?></td>
                                    <td>
                                        <select name="legend_floating" id="legend_floating">
                                            <option value="0"><?php echo $global['no']; ?></option>
                                            <option value="1"><?php echo $global['yes']; ?></option>
                                        </select>
                                    </td>
                                    <td><?php echo $graph['legendItemDistance']; ?></td>
                                    <td><input type="number" value="" name="legend_item_distance" id="legend_item_distance"></td>
                                </tr>
                                <tr>
                                    <td><?php echo $graph['legendItemMarginBottom']; ?></td>
                                    <td><input type="number" value="" name="legend_item_margin_bottom" id="legend_item_margin_bottom"></td>
                                    <td><?php echo $graph['legendItemMarginTop']; ?></td>
                                    <td><input type="number" value="" name="legend_item_margin_top" id="legend_item_margin_top"></td>
                                </tr>
                                <tr>
                                    <td><?php echo $graph['legendLayout']; ?></td>
                                    <td>
                                        <select name="legend_layout" id="legend_layout">
                                            <option value="horizontal"><?php echo $graph['horizontal']; ?></option>
                                            <option value="vertical"><?php echo $graph['vertical']; ?></option>
                                        </select>
                                    </td>
                                    <td><?php echo $graph['legendLineHeight']; ?></td>
                                    <td><input type="number" value="" name="legend_line_height" id="legend_line_height"></td>
                                </tr>
                                <tr>
                                    <td><?php echo $graph['legendMargin']; ?></td>
                                    <td><input type="number" value="" name="legend_margin" id="legend_margin"></td>
                                    <td><?php echo $graph['legendPadding']; ?></td>
                                    <td><input type="number" value="" name="legend_padding" id="legend_padding"></td>
                                </tr>
                                <tr>
                                    <td><?php echo $graph['legendReversed']; ?></td>
                                    <td>
                                        <select name="legend_reversed" id="legend_reversed">
                                            <option value="0"><?php echo $global['no']; ?></option>
                                            <option value="1"><?php echo $global['yes']; ?></option>
                                        </select>
                                    </td>
                                    <td><?php echo $graph['legendShadow']; ?></td>
                                    <td>
                                        <select name="legend_shadow" id="legend_shadow">
                                            <option value="0"><?php echo $global['no']; ?></option>
                                            <option value="1"><?php echo $global['yes']; ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $graph['legendTitle']; ?></td>
                                    <td><input type="text" value="" name="legend_title" id="legend_title"></td>
                                    <td><?php echo $graph['legendVerticalAlign']; ?></td>
                                    <td>
                                        <select name="legend_vertical_align" id="legend_vertical_align">
                                            <option value="bottom"><?php echo $global['bottom']; ?></option>
                                            <option value="top"><?php echo $global['top']; ?></option>
                                            <option value="middle"><?php echo $global['middle']; ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $graph['legendWidth']; ?></td>
                                    <td><input type="number" value="" name="legend_width" id="legend_width"></td>
                                    <td><?php echo $graph['legendX']; ?></td>
                                    <td><input type="number" value="" name="legend_x" id="legend_x"></td>
                                </tr>
                                <tr>
                                    <td><?php echo $graph['legendY']; ?></td>
                                    <td><input type="number" value="" name="legend_y" id="legend_y"></td>
                                    <td><?php echo $graph['colors']; ?></td>
                                    <td><input type="text" value="" name="colors" id="colors"></td>
                                </tr>
                                <tr>
                                    <td><?php echo $graph['title']; ?></td>
                                    <td><input type="text" value="" name="title" id="title"></td>
                                    <td><?php echo $graph['subtitle']; ?></td>
                                    <td><input type="text" value="" name="subtitle" id="subtitle"></td>
                                </tr>
                                <tr>
                                    <td><?php echo $graph['xAxisLineColor']; ?></td>
                                    <td><input type="color" value="" name="xAxis_lineColor" id="xAxis_lineColor"></td>
                                    <td><?php echo $graph['xAxisLineWidth']; ?></td>
                                    <td><input type="number" value="" name="xAxis_lineWidth" id="xAxis_lineWidth"></td>
                                </tr>
                                <tr>
                                    <td><?php echo $graph['xAxisGridLineColor']; ?></td>
                                    <td><input type="color" value="" name="xAxis_gridLineColor" id="xAxis_gridLineColor"></td>
                                    <td><?php echo $graph['xAxisGridLineWidth']; ?></td>
                                    <td><input type="number" value="" name="xAxis_gridLineWidth" id="xAxis_gridLineWidth"></td>
                                </tr>
                                <tr>
                                    <td><?php echo $graph['yAxisLineColor']; ?></td>
                                    <td><input type="color" value="" name="yAxis_lineColor" id="yAxis_lineColor"></td>
                                    <td><?php echo $graph['yAxisLineWidth']; ?></td>
                                    <td><input type="number" value="" name="yAxis_lineWidth" id="yAxis_lineWidth"></td>
                                </tr>
                                <tr>
                                    <td><?php echo $graph['yAxisGridLineColor']; ?></td>
                                    <td><input type="color" value="" name="yAxis_gridLineColor" id="yAxis_gridLineColor"></td>
                                    <td><?php echo $graph['yAxisGridLineWidth']; ?></td>
                                    <td><input type="number" value="" name="yAxis_gridLineWidth" id="yAxis_gridLineWidth"></td>
                                </tr>
                                <tr>
                                    <td><?php echo $graph['enableMouseTracking']; ?></td>
                                    <td>
                                        <select name="enableMouseTracking" id="enableMouseTracking">
                                            <option value="0"><?php echo $global['no']; ?></option>
                                            <option value="1"><?php echo $global['yes']; ?></option>
                                        </select>
                                    </td>
                                    <td><?php echo $graph['markerEnabled']; ?></td>
                                    <td>
                                        <select name="markerEnabled" id="markerEnabled">
                                            <option value="0"><?php echo $global['no']; ?></option>
                                            <option value="1"><?php echo $global['yes']; ?></option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $graph['titleAlign']; ?></td>
                                    <td>
                                        <select name="title_align" id="title_align">
                                            <option value="center"><?php echo $graph['center']; ?></option>
                                            <option value="left"><?php echo $graph['left']; ?></option>
                                            <option value="right"><?php echo $graph['right']; ?></option>
                                        </select>
                                    </td>
                                    <td><?php echo $graph['titleColor']; ?></td>
                                    <td><input type="color" value="" name="title_color" id="title_color"></td>
                                </tr>
                                <tr>
                                    <td><?php echo $graph['xAxisAlign']; ?></td>
                                    <td>
                                        <select name="xAxis_align" id="xAxis_align">
                                            <option value="middle"><?php echo $graph['middle']; ?></option>
                                            <option value="low"><?php echo $graph['low']; ?></option>
                                            <option value="high"><?php echo $graph['high']; ?></option>
                                        </select>
                                    </td>
                                    <td><?php echo $graph['xAxisText']; ?></td>
                                    <td><input type="text" value="" name="xAxis_text" id="xAxis_text"></td>
                                </tr>
                                <tr>
                                    <td><?php echo $graph['yAxisAlign']; ?></td>
                                    <td>
                                        <select name="yAxis_align" id="yAxis_align">
                                            <option value="middle"><?php echo $graph['middle']; ?></option>
                                            <option value="low"><?php echo $graph['low']; ?></option>
                                            <option value="high"><?php echo $graph['high']; ?></option>
                                        </select>
                                    </td>
                                    <td><?php echo $graph['yAxisText']; ?></td>
                                    <td><input type="text" value="" name="yAxis_text" id="yAxis_text"></td>
                                </tr>
                                <tr>
                                    <td><?php echo $graph['pieSeriesName']; ?></td>
                                    <td><input type="text" value="" name="pie_series_name" id="pie_series_name"></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </fieldset>
                </div>
            </form>
            
      </div>
        
        

        <div id="previewForm">
            <form method="post" action="#"> 
                <div class="form-buttons">
                    <a href="javascript:none();" class="primaryButton" id="btnBack"><?php echo $btn['back']; ?></a>&nbsp;
                </div>

                <div class="form-main">
                    <fieldset>
                        <div id="graph-iphone">
                        </div>
                    </fieldset>

                    <fieldset>
                        <div id="graph-ipad">
                        </div>
                    </fieldset>
                </div>
            </form>
        </div>
    </div>
</div>



<div id="fields-window">
    <div id="field-form">
        <a href="javascript:none();" class="declineButton" id="closeFieldsForm"><?php echo $btn['close']; ?></a>&nbsp;
        <a href="javascript:none();" class="primaryButton" id="saveNewField"><?php echo $btn['save']; ?></a>&nbsp;
        <a href="javascript:none();" class="primaryButton" id="updateField"><?php echo $btn['update']; ?></a>&nbsp;
        <a href="javascript:none();" class="primaryButton" id="activateField"><?php echo $btn['activate']; ?></a>&nbsp;
        <a href="javascript:none();" class="declineButton" id="deleteField"><?php echo $btn['delete']; ?></a>&nbsp;
        <div>
            <div>
                <label for="field-name"><?php echo "FIELD NAME"; ?></label>
                <input type="text" required name="field-name" id="field-name">
            </div>

            <div>
                <label for="field-length"><?php echo "LENGTH"; ?></label>
                <input type="number" required name="field-length" id="field-length">
            </div>

            <div>
                <label for="field-type"><?php echo "FIELD TYPE"; ?></label>
                <select name="field-type" id="field-type">
                    <option value="4">String</option>
                    <option value="2">Date</option>
                    <option value="1">Number</option>
                </select>
            </div>

            <div>
                <label for="field-format"><?php echo "FORMAT"; ?></label>
                <input type="text" required name="field-format" id="field-format">
            </div>

            <div>
                <label for="field-align"><?php echo "ALIGN"; ?></label>
                <select name="field-align" id="field-align">
                    <option value="Center">Center</option>
                    <option value="Left">Left</option>
                    <option value="Right">Right</option>
                </select>
            </div>


        </div>
    </div>


    <a href="javascript:none();" class="primaryButton" id="addField"><?php echo "ADD FIELD"; ?></a>&nbsp;
    <a href="javascript:none();" class="primaryButton" id="editField"><?php echo "EDIT"; ?></a>&nbsp;

    <ol id="fields-list" class="sortable ui-sortable">

    </ol>

</div>

<script src="js/categories.js"></script>
<script src="js/graphs.js"></script>