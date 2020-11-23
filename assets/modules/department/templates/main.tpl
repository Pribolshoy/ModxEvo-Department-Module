<!DOCTYPE html>
<html lang="en">
<head>
    <title>[+module_title+]</title>
    <link rel="stylesheet" type="text/css" href="media/style[+theme+]/style.css" />
    <script type="text/javascript" src="media/script/tabpane.js"></script>
    <script type="text/javascript" src="media/script/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="media/script/mootools/mootools.js"></script>
    <script type="text/javascript" src="../assets/modules/department/js/department.js"></script>
</head>
<body>
<h1 class="pagetitle">
    <span class="pagetitle-icon">
	    <i class="fa fa-shopping-bag"></i>
    </span>
    <span class="pagetitle-text">[+module_title+]</span>
</h1>
<div class="sectionBody" id="andyShopPane">
    <div class="tab-pane">
        <script type="text/javascript">
            tpResources = new WebFXTabPane( document.getElementById( "andyShopPane" ), true);
        </script>
    </div>

    <div class="tab-page" id="scheme-1">
        <h2 class="tab"><i class="fa fa-newspaper-o"></i>Схема 1</h2>
        <script type="text/javascript">tpResources.addTabPage( document.getElementById( "scheme-1" ) );</script>
        <!-- здесь содержимое вкладки -->
        <div class="tab-body">
            <div class="tab-section">
                <div class="tab-header">[+scheme1_title+]</div>
                <div class="tab-body">
                    <div id="scheme1_content">
                        [+scheme1_content+]
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-page" id="scheme-2">
        <h2 class="tab"><i class="fa fa-newspaper-o"></i>Схема 2</h2>
        <script type="text/javascript">tpResources.addTabPage( document.getElementById( "scheme-2" ) );</script>
        <!-- здесь содержимое вкладки -->
        <div class="tab-body">
            <div class="tab-section">
                <div class="tab-header">[+scheme2_title+]</div>
                <div class="tab-body">
                    <div id="scheme2_content">
                        [+scheme2_content+]
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-page" id="scheme-3">
        <h2 class="tab"><i class="fa fa-newspaper-o"></i>Схема 3</h2>
        <script type="text/javascript">tpResources.addTabPage( document.getElementById( "scheme-3" ) );</script>
        <!-- здесь содержимое вкладки -->
        <div class="tab-body">
            <div class="tab-section">
                <div class="tab-header">[+scheme3_title+]</div>
                <div class="tab-body">
                    <div id="scheme3_content">
                        [+scheme3_content+]
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-page" id="scheme-4">
        <h2 class="tab"><i class="fa fa-newspaper-o"></i>Схема 4</h2>
        <script type="text/javascript">tpResources.addTabPage( document.getElementById( "scheme-4" ) );</script>
        <!-- здесь содержимое вкладки -->
        <div class="tab-body">
            <div class="tab-section">
                <div class="tab-header">[+scheme4_title+]</div>
                <div class="tab-body">
                    <form name="range" id="range" action="" method="post">
                        <div class="input-group">
                            <input id="employees_count" class="form-control" name="employees_count" type="text" value="[+employees_count+]" />
                            <span class="input-group-btn">
                                <input class="btn" type="submit" name="fsubmit" onclick="refreshScheme4(); return false;" value="Обновить" />
                            </span>
                        </div>
                    </form>
                    <br>
                    <div id="scheme4_content">
                        [+scheme4_content+]
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-page" id="scheme-5">
        <h2 class="tab"><i class="fa fa-newspaper-o"></i>Схема 5</h2>
        <script type="text/javascript">tpResources.addTabPage( document.getElementById( "scheme-5" ) );</script>
        <!-- здесь содержимое вкладки -->
        <div class="tab-body">
            <div class="tab-section">
                <div class="tab-header">[+scheme5_title+]</div>
                <div class="tab-body">
                    <form name="range" id="range" action="" method="post">
                        <div class="input-group">
                            <input id="employees_count" class="form-control" name="salary_count" type="text" value="[+salary_count+]" />
                            <span class="input-group-btn">
                                <input class="btn" type="submit" name="fsubmit" onclick="refreshScheme5(); return false;" value="Обновить" />
                            </span>
                        </div>
                    </form>
                    <br>
                    <div id="scheme5_content">
                        [+scheme5_content+]
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</body>
</html>