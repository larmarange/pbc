var FiltersEnabled = 0; // if your not going to use transitions or filters in any of the tips set this to 0
var spacer="&nbsp; &nbsp; &nbsp; ";

// email notifications to admin
notifyAdminNewMembers0Tip=["", spacer+"No email notifications to admin."];
notifyAdminNewMembers1Tip=["", spacer+"Notify admin only when a new member is waiting for approval."];
notifyAdminNewMembers2Tip=["", spacer+"Notify admin for all new sign-ups."];

// visitorSignup
visitorSignup0Tip=["", spacer+"If this option is selected, visitors will not be able to join this group unless the admin manually moves them to this group from the admin area."];
visitorSignup1Tip=["", spacer+"If this option is selected, visitors can join this group but will not be able to sign in unless the admin approves them from the admin area."];
visitorSignup2Tip=["", spacer+"If this option is selected, visitors can join this group and will be able to sign in instantly with no need for admin approval."];

// conventions table
conventions_addTip=["",spacer+"This option allows all members of the group to add records to the 'Conventions' table. A member who adds a record to the table becomes the 'owner' of that record."];

conventions_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Conventions' table."];
conventions_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Conventions' table."];
conventions_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Conventions' table."];
conventions_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Conventions' table."];

conventions_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Conventions' table."];
conventions_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Conventions' table."];
conventions_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Conventions' table."];
conventions_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Conventions' table, regardless of their owner."];

conventions_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Conventions' table."];
conventions_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Conventions' table."];
conventions_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Conventions' table."];
conventions_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Conventions' table."];

// budgets table
budgets_addTip=["",spacer+"This option allows all members of the group to add records to the 'Lignes budg&#233;taires' table. A member who adds a record to the table becomes the 'owner' of that record."];

budgets_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Lignes budg&#233;taires' table."];
budgets_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Lignes budg&#233;taires' table."];
budgets_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Lignes budg&#233;taires' table."];
budgets_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Lignes budg&#233;taires' table."];

budgets_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Lignes budg&#233;taires' table."];
budgets_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Lignes budg&#233;taires' table."];
budgets_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Lignes budg&#233;taires' table."];
budgets_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Lignes budg&#233;taires' table, regardless of their owner."];

budgets_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Lignes budg&#233;taires' table."];
budgets_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Lignes budg&#233;taires' table."];
budgets_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Lignes budg&#233;taires' table."];
budgets_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Lignes budg&#233;taires' table."];

// versements table
versements_addTip=["",spacer+"This option allows all members of the group to add records to the 'Versements (bailleur)' table. A member who adds a record to the table becomes the 'owner' of that record."];

versements_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Versements (bailleur)' table."];
versements_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Versements (bailleur)' table."];
versements_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Versements (bailleur)' table."];
versements_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Versements (bailleur)' table."];

versements_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Versements (bailleur)' table."];
versements_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Versements (bailleur)' table."];
versements_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Versements (bailleur)' table."];
versements_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Versements (bailleur)' table, regardless of their owner."];

versements_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Versements (bailleur)' table."];
versements_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Versements (bailleur)' table."];
versements_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Versements (bailleur)' table."];
versements_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Versements (bailleur)' table."];

// lignes_credits table
lignes_credits_addTip=["",spacer+"This option allows all members of the group to add records to the 'Lignes de Cr&#233;dits' table. A member who adds a record to the table becomes the 'owner' of that record."];

lignes_credits_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Lignes de Cr&#233;dits' table."];
lignes_credits_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Lignes de Cr&#233;dits' table."];
lignes_credits_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Lignes de Cr&#233;dits' table."];
lignes_credits_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Lignes de Cr&#233;dits' table."];

lignes_credits_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Lignes de Cr&#233;dits' table."];
lignes_credits_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Lignes de Cr&#233;dits' table."];
lignes_credits_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Lignes de Cr&#233;dits' table."];
lignes_credits_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Lignes de Cr&#233;dits' table, regardless of their owner."];

lignes_credits_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Lignes de Cr&#233;dits' table."];
lignes_credits_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Lignes de Cr&#233;dits' table."];
lignes_credits_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Lignes de Cr&#233;dits' table."];
lignes_credits_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Lignes de Cr&#233;dits' table."];

// credits table
credits_addTip=["",spacer+"This option allows all members of the group to add records to the 'Cr&#233;dits (ouverture)' table. A member who adds a record to the table becomes the 'owner' of that record."];

credits_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Cr&#233;dits (ouverture)' table."];
credits_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Cr&#233;dits (ouverture)' table."];
credits_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Cr&#233;dits (ouverture)' table."];
credits_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Cr&#233;dits (ouverture)' table."];

credits_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Cr&#233;dits (ouverture)' table."];
credits_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Cr&#233;dits (ouverture)' table."];
credits_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Cr&#233;dits (ouverture)' table."];
credits_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Cr&#233;dits (ouverture)' table, regardless of their owner."];

credits_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Cr&#233;dits (ouverture)' table."];
credits_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Cr&#233;dits (ouverture)' table."];
credits_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Cr&#233;dits (ouverture)' table."];
credits_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Cr&#233;dits (ouverture)' table."];

// ventilation table
ventilation_addTip=["",spacer+"This option allows all members of the group to add records to the 'Ventilation Budg&#233;taire' table. A member who adds a record to the table becomes the 'owner' of that record."];

ventilation_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Ventilation Budg&#233;taire' table."];
ventilation_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Ventilation Budg&#233;taire' table."];
ventilation_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Ventilation Budg&#233;taire' table."];
ventilation_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Ventilation Budg&#233;taire' table."];

ventilation_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Ventilation Budg&#233;taire' table."];
ventilation_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Ventilation Budg&#233;taire' table."];
ventilation_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Ventilation Budg&#233;taire' table."];
ventilation_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Ventilation Budg&#233;taire' table, regardless of their owner."];

ventilation_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Ventilation Budg&#233;taire' table."];
ventilation_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Ventilation Budg&#233;taire' table."];
ventilation_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Ventilation Budg&#233;taire' table."];
ventilation_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Ventilation Budg&#233;taire' table."];

// recrutements table
recrutements_addTip=["",spacer+"This option allows all members of the group to add records to the 'Recrutements' table. A member who adds a record to the table becomes the 'owner' of that record."];

recrutements_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Recrutements' table."];
recrutements_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Recrutements' table."];
recrutements_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Recrutements' table."];
recrutements_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Recrutements' table."];

recrutements_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Recrutements' table."];
recrutements_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Recrutements' table."];
recrutements_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Recrutements' table."];
recrutements_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Recrutements' table, regardless of their owner."];

recrutements_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Recrutements' table."];
recrutements_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Recrutements' table."];
recrutements_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Recrutements' table."];
recrutements_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Recrutements' table."];

// depenses table
depenses_addTip=["",spacer+"This option allows all members of the group to add records to the 'D&#233;penses' table. A member who adds a record to the table becomes the 'owner' of that record."];

depenses_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'D&#233;penses' table."];
depenses_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'D&#233;penses' table."];
depenses_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'D&#233;penses' table."];
depenses_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'D&#233;penses' table."];

depenses_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'D&#233;penses' table."];
depenses_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'D&#233;penses' table."];
depenses_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'D&#233;penses' table."];
depenses_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'D&#233;penses' table, regardless of their owner."];

depenses_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'D&#233;penses' table."];
depenses_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'D&#233;penses' table."];
depenses_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'D&#233;penses' table."];
depenses_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'D&#233;penses' table."];

// fichiers table
fichiers_addTip=["",spacer+"This option allows all members of the group to add records to the 'Fichiers' table. A member who adds a record to the table becomes the 'owner' of that record."];

fichiers_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Fichiers' table."];
fichiers_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Fichiers' table."];
fichiers_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Fichiers' table."];
fichiers_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Fichiers' table."];

fichiers_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Fichiers' table."];
fichiers_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Fichiers' table."];
fichiers_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Fichiers' table."];
fichiers_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Fichiers' table, regardless of their owner."];

fichiers_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Fichiers' table."];
fichiers_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Fichiers' table."];
fichiers_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Fichiers' table."];
fichiers_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Fichiers' table."];

// personnes table
personnes_addTip=["",spacer+"This option allows all members of the group to add records to the 'Individus' table. A member who adds a record to the table becomes the 'owner' of that record."];

personnes_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Individus' table."];
personnes_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Individus' table."];
personnes_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Individus' table."];
personnes_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Individus' table."];

personnes_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Individus' table."];
personnes_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Individus' table."];
personnes_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Individus' table."];
personnes_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Individus' table, regardless of their owner."];

personnes_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Individus' table."];
personnes_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Individus' table."];
personnes_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Individus' table."];
personnes_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Individus' table."];

// types_ligne table
types_ligne_addTip=["",spacer+"This option allows all members of the group to add records to the 'Type de lignes budg&#233;taires' table. A member who adds a record to the table becomes the 'owner' of that record."];

types_ligne_view0Tip=["",spacer+"This option prohibits all members of the group from viewing any record in the 'Type de lignes budg&#233;taires' table."];
types_ligne_view1Tip=["",spacer+"This option allows each member of the group to view only his own records in the 'Type de lignes budg&#233;taires' table."];
types_ligne_view2Tip=["",spacer+"This option allows each member of the group to view any record owned by any member of the group in the 'Type de lignes budg&#233;taires' table."];
types_ligne_view3Tip=["",spacer+"This option allows each member of the group to view all records in the 'Type de lignes budg&#233;taires' table."];

types_ligne_edit0Tip=["",spacer+"This option prohibits all members of the group from modifying any record in the 'Type de lignes budg&#233;taires' table."];
types_ligne_edit1Tip=["",spacer+"This option allows each member of the group to edit only his own records in the 'Type de lignes budg&#233;taires' table."];
types_ligne_edit2Tip=["",spacer+"This option allows each member of the group to edit any record owned by any member of the group in the 'Type de lignes budg&#233;taires' table."];
types_ligne_edit3Tip=["",spacer+"This option allows each member of the group to edit any records in the 'Type de lignes budg&#233;taires' table, regardless of their owner."];

types_ligne_delete0Tip=["",spacer+"This option prohibits all members of the group from deleting any record in the 'Type de lignes budg&#233;taires' table."];
types_ligne_delete1Tip=["",spacer+"This option allows each member of the group to delete only his own records in the 'Type de lignes budg&#233;taires' table."];
types_ligne_delete2Tip=["",spacer+"This option allows each member of the group to delete any record owned by any member of the group in the 'Type de lignes budg&#233;taires' table."];
types_ligne_delete3Tip=["",spacer+"This option allows each member of the group to delete any records in the 'Type de lignes budg&#233;taires' table."];

/*
	Style syntax:
	-------------
	[TitleColor,TextColor,TitleBgColor,TextBgColor,TitleBgImag,TextBgImag,TitleTextAlign,
	TextTextAlign,TitleFontFace,TextFontFace, TipPosition, StickyStyle, TitleFontSize,
	TextFontSize, Width, Height, BorderSize, PadTextArea, CoordinateX , CoordinateY,
	TransitionNumber, TransitionDuration, TransparencyLevel ,ShadowType, ShadowColor]

*/

toolTipStyle=["white","#00008B","#000099","#E6E6FA","","images/helpBg.gif","","","","\"Trebuchet MS\", sans-serif","","","","3",400,"",1,2,10,10,51,1,0,"",""];

applyCssFilter();
