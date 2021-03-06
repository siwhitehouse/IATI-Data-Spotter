<?php
$title = "IATI Batch process results";
$pages = array( "basic_statistics" => "statistics.php",
                "detect_xml" => "headers.php",
                "organisation_files" => "organisation.php",
                "missing_urls" => "urls.php",
                "unique_activities" => "unique.php",
                "missing_elements" => "missing.php",
                "codes" => "codes.php",
                "identifier_format" => "identifiers.php",
                "country_list" => "country.php",
                "recipient_region_codes" => "region_codes.php",
                "transactions" => "transactions.php",
                "transactions_list" => "transactions_list.php",
                "activity_list" => "activity_list.php",
                "transactions_by_year" => "transactions_by_year.php",
                "transactions_missing_elements" => "transactions_missing_elements.php",
                "default_elements" => "defaults.php",
                "iati_elements" => "iati.php"
              );
              
$overview_menu =     array("basic_statistics" => array("link"=>"statistics.php","title"=>"Basic Statistics"),
                        );            

$validation_menu =   array("validate" => array("link"=>"validate.php","title"=>"Validate Files"),
                           "detect_xml" => array("link"=>"headers.php","title"=>"Detect XML"),
                           "identifier_format" => array("link"=>"identifiers.php","title"=>"Identifier Format"),
                           "missing_urls" => array("link"=>"urls.php","title"=>"Missing URLs"),
                           "organisation_files" => array("link"=>"organisation.php","title"=>"Organisation File"),
                          );

$activities_menu =    array("unique_activities" => array("link"=>"unique.php","title"=>"Unique Activities"),
                            "activity_list" => array("link"=>"activity_list.php","title"=>"Activity List"),
                            );
$participating_org_menu =    array("part_org_missing_refs" => array("link"=>"part_org_missing_refs.php","title"=>"Missing Refs"),
                                    "part_org_not_on_code_list" => array("link"=>"part_org_not_on_code_list.php","title"=>"Ref not on list"),
                                    "part_org_mismatch_refs" => array("link"=>"part_org_mismatch_refs","title"=>"Mismatch Refs"),
                                    //"part_org_missmatch_codes" => array("link"=>"part_org_missmatch_codes.php","title"=>"Mismatch Refs"),
                            //"activity_list" => array("link"=>"activity_list.php","title"=>"Activity List"),
                            );
                    
                    
$elements_menu =      array("missing_elements" => array("link"=>"missing.php","title"=>"Missing Elements"),
                            "default_elements" => array("link"=>"defaults.php","title"=>"Default Elements"),
                            "iati_elements" => array("link"=>"iati.php","title"=>"IATI Elements"),
                            "missing_country_elements" => array("link" => "missing_country_elements.php", "title" => "Region/Country"),
                            "currency" => array("link" => "currency.php", "title" => "Currency Checks")
                            );

$codelists_menu =     array(//"codes" => array("link"=>"codes.php","title"=>"Codes"),
                            "country_list" => array("link"=>"country.php","title"=>"Country Lists"),
                            "recipient_region_codes" => array("link"=>"region_codes.php","title"=>"Recipient Region"),
                            "activity_status_count" => array("link"=> "activity_status_count.php", "title"=>"Activity Status Count"),
                            "participating_org_count" => array("link"=> "participating_org_count.php", "title"=>"Participating Org. Count")
                      );

$transactions_menu =  array("transactions" => array("link"=>"transactions.php","title"=>"Overview"),
                            "transactions_by_year" => array("link"=>"transactions_by_year.php","title"=>"By Year"),
                            "transactions_list" => array("link"=>"transactions_list.php","title"=>"List"),
                            "transactions_integers" => array("link"=>"transactions_integers.php","title"=>"Integer Check"),
                            "transactions_count" => array("link"=> "transactions_count.php", "title"=>"Count"),
                            "transactions_missing_elements" => array("link"=>"transactions_missing_elements.php","title"=>"Missing Elements"),
                            );
                            
$budgets_menu =       array(//"transactions" => array("link"=>"transactions.php","title"=>"Overview"),
                            //"transactions_by_year" => array("link"=>"transactions_by_year.php","title"=>"By Year"),
                            //"transactions_list" => array("link"=>"transactions_list.php","title"=>"List"),
                            "budgets_count" => array("link"=> "budgets_count.php", "title"=>"Count"),
                            "budgets_missing_elements" => array("link"=>"budgets_missing_elements.php","title"=>"Missing Elements"),
                            );
$date_time_menu =     array(//"transactions" => array("link"=>"transactions.php","title"=>"Overview"),
                            //"transactions_by_year" => array("link"=>"transactions_by_year.php","title"=>"By Year"),
                            //"transactions_list" => array("link"=>"transactions_list.php","title"=>"List"),
                            "time_generated" => array("link"=> "time_generated.php", "title"=>"Generated Time"),
                            "time_updated" => array("link"=> "time_updated.php", "title"=>"Last Updated Time"),
                            "date_validates" => array("link"=>"date_validates.php","title"=>"Iso-date Validation"),
                            "date_value_validates" => array("link"=>"date_value_validates.php","title"=>"Value-date Validation"),
                            );
$documents_menu =      array("document_links" => array("link"=>"document_links.php","title"=>"Document Links"),
                            //"default_elements" => array("link"=>"defaults.php","title"=>"Default Elements"),
                            //"iati_elements" => array("link"=>"iati.php","title"=>"IATI Elements"),
                            //"missing_country_elements" => array("link" => "missing_country_elements.php", "title" => "Region/Country"),
                            //"currency" => array("link" => "currency.php", "title" => "Currency Checks")
                            );
$sector_menu =      array("sector" => array("link"=>"sector.php","title"=>"Sector"),
                            "sector_list" => array("link"=>"sector_list.php","title"=>"Sector List"),
                            //"iati_elements" => array("link"=>"iati.php","title"=>"IATI Elements"),
                            //"missing_country_elements" => array("link" => "missing_country_elements.php", "title" => "Region/Country"),
                            //"currency" => array("link" => "currency.php", "title" => "Currency Checks")
                            );

$menus = array("overview","validation","activities","participating_org","elements","codelists","transactions","budgets","sector","date_time","documents");
