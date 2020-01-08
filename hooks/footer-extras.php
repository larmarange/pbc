<style>
.navbar-header a {text-transform: uppercase !important;}

/* masquer champs inutiles dans les sous-tables
   https://bigprof.com/blog/appgini/how-to-hide-a-field-in-child-table-view/ */

#panel_budgets-convention .budgets-convention {display: none;}
#panel_ventilation-convention .ventilation-convention {display: none;}
#panel_versements-convention .versements-convention {display: none;}
#panel_credits-convention .credits-convention {display: none;}
#panel_depenses-convention .depenses-convention {display: none;}
#panel_fichiers-convention .fichiers-convention {display: none;}

#panel_depenses-ligne .depenses-ligne {display: none;}
#panel_depenses-ligne .depenses-convention {display: none;}
#panel_versements-ligne .versements-ligne {display: none;}
#panel_versements-ligne .versements-convention {display: none;}
#panel_credits-ligne .credits-ligne {display: none;}
#panel_credits-ligne .credits-convention {display: none;}

#panel_depenses-ventilation .depenses-ventilation {display: none;}
#panel_depenses-ventilation .depenses-convention {display: none;}

/* afficher champs sur une seule ligne dans les vues tables */
/* sauf si aligné à droite (nombre) */
.table_view td, .tab-content td {white-space: normal;}
.table_view td.text-right, .tab-content td.text-right {white-space: nowrap;}

.children-tabs {margin: 0 10px;}
</style>

<script type="text/javascript">
  /* plus d'espace pour les sous-tables */
  $j(".children-tabs").parent().removeClass("col-lg-10 col-lg-offset-1");

  // cf. https://bigprof.com/blog/appgini/displaying-count-of-child-records-on-the-tab-title/
  $j(function() {
      setInterval(function() {
          $j('.children-tabs tfoot td').each(function() {
              var txt = $j(this).text().trim();
              // The line below assumes your app is in English language .. modify if it's in a different lang.
              var pattern = /Records [0-9]+ to [0-9]+ of ([0-9]+)/g;
              var match, recs;
              match = pattern.exec(txt);
              recs = (match !== null ? match[1] : 0);
              var id = '#' + $j(this).parents('.tab-pane').attr('id').replace(/^panel/, 'tab');

              if(!$j(id + ' .badge').length) {
                  $j('<span class="badge hspacer-md"></span>').appendTo(id);
              }
              $j(id + ' .badge').html(recs);
          })
      }, 1000);
  })
</script>
