<?php

namespace Mpwar\Sphinx;
include '/var/lib/sphinx/api/sphinxapi.php';

	class SearchSphinx 
	{
  
		const TABLE = 'municipios';
		
		public function search ($provincia, $numItemStart, $numItemsPage)
		{
			
			$query_string = $provincia;
			$sphinx = new \SphinxClient();
			$sphinx->SetServer( '127.0.0.1', 9312);
			$sphinx->SetMatchMode( SPH_MATCH_EXTENDED );
			$sphinx->SetSortMode( SPH_SORT_RELEVANCE );
			
			$sphinx->SetLimits( $numItemStart, $numItemsPage );

			$sphinx->AddQuery( $query_string, self::TABLE );
			$results = $sphinx->RunQueries();
			
			if ( !empty( $results[0]['matches'] ) )
			{
				return $results;
				
			}
			else
			{
			    return '';
			}
		}
	}