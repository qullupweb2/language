<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>1.0</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/deutschkurse-hannover-a1</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>1.0</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/deutschkurse-hannover-a2</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>1.0</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/deutschkurse-hannover-b1</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>1.0</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/deutschkurse-hannover-b2</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>1.0</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/deutschkurse-hannover-c1</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>1.0</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/testdaf-hannover</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>1.0</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/deutschkurs-fuer-aerzte</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>1.0</priority>
			</url>
		@foreach ($pages as $page)
			<url>
				<loc>{{ url($page->slug) }}</loc>
				<lastmod>{{ $page->updated_at->tz('GMT')->toAtomString() }}</lastmod>
				<priority>1.0</priority>
			</url>
		@endforeach
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/pruefung-anmelden</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>1.0</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/deutsch-lernen-online-kostenlos</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>1.0</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/zimmer-buchen</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>1.0</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/en/deutschkurse-hannover-a1</loc>
				<lastmod>2020-06-04T14:09:54+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/ru/deutschkurse-hannover-a1</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/tr/deutschkurse-hannover-a1</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/es/deutschkurse-hannover-a1</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/zh/deutschkurse-hannover-a1</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/fr/deutschkurse-hannover-a1</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/vi/deutschkurse-hannover-a1</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/en/deutschkurse-hannover-a2</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/ru/deutschkurse-hannover-a2</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/tr/deutschkurse-hannover-a2</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/es/deutschkurse-hannover-a2</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/zh/deutschkurse-hannover-a2</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/fr/deutschkurse-hannover-a2</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/vi/deutschkurse-hannover-a2</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/en/deutschkurse-hannover-b1</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/ru/deutschkurse-hannover-b1</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/tr/deutschkurse-hannover-b1</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/es/deutschkurse-hannover-b1</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/zh/deutschkurse-hannover-b1</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/fr/deutschkurse-hannover-b1</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/vi/deutschkurse-hannover-b1</loc>
				<lastmod>{{$date}}</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/en/deutschkurse-hannover-c1</loc>
				<lastmod>2020-06-04T14:10:22+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/ru/deutschkurse-hannover-c1</loc>
				<lastmod>2020-06-04T14:10:22+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/tr/deutschkurse-hannover-c1</loc>
				<lastmod>2020-06-04T14:10:23+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/es/deutschkurse-hannover-c1</loc>
				<lastmod>2020-06-04T14:10:22+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/zh/deutschkurse-hannover-c1</loc>
				<lastmod>2020-06-04T14:10:23+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/fr/deutschkurse-hannover-c1</loc>
				<lastmod>2020-06-04T14:10:22+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/vi/deutschkurse-hannover-c1</loc>
				<lastmod>2020-06-04T14:10:23+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/en/testdaf-hannover</loc>
				<lastmod>2020-06-04T14:10:27+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/ru/testdaf-hannover</loc>
				<lastmod>2020-06-04T14:10:28+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/tr/testdaf-hannover</loc>
				<lastmod>2020-06-04T14:10:27+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/es/testdaf-hannover</loc>
				<lastmod>2020-06-04T14:10:27+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/zh/testdaf-hannover</loc>
				<lastmod>2020-06-04T14:10:28+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/fr/testdaf-hannover</loc>
				<lastmod>2020-06-04T14:10:29+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/vi/testdaf-hannover</loc>
				<lastmod>2020-06-04T14:10:28+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/en/deutschkurse-hannover-b2</loc>
				<lastmod>2020-06-04T14:10:29+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/ru/deutschkurse-hannover-b2</loc>
				<lastmod>2020-06-04T14:10:30+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/tr/deutschkurse-hannover-b2</loc>
				<lastmod>2020-06-04T14:10:29+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/es/deutschkurse-hannover-b2</loc>
				<lastmod>2020-06-04T14:10:30+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/zh/deutschkurse-hannover-b2</loc>
				<lastmod>2020-06-04T14:10:31+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/fr/deutschkurse-hannover-b2</loc>
				<lastmod>2020-06-04T14:10:31+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/vi/deutschkurse-hannover-b2</loc>
				<lastmod>2020-06-04T14:10:31+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/en/deutschkurs-fuer-aerzte</loc>
				<lastmod>2020-06-04T14:10:41+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/ru/deutschkurs-fuer-aerzte</loc>
				<lastmod>2020-06-04T14:10:42+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/tr/deutschkurs-fuer-aerzte</loc>
				<lastmod>2020-06-04T14:10:42+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/es/deutschkurs-fuer-aerzte</loc>
				<lastmod>2020-06-04T14:10:42+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/zh/deutschkurs-fuer-aerzte</loc>
				<lastmod>2020-06-04T14:10:42+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/fr/deutschkurs-fuer-aerzte</loc>
				<lastmod>2020-06-04T14:10:43+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/vi/deutschkurs-fuer-aerzte</loc>
				<lastmod>2020-06-04T14:10:44+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/en/deutsch-lernen-online-kostenlos</loc>
				<lastmod>2020-06-04T14:10:44+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/ru/deutsch-lernen-online-kostenlos</loc>
				<lastmod>2020-06-04T14:10:45+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/tr/deutsch-lernen-online-kostenlos</loc>
				<lastmod>2020-06-04T14:10:44+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/es/deutsch-lernen-online-kostenlos</loc>
				<lastmod>2020-06-04T14:10:44+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/zh/deutsch-lernen-online-kostenlos</loc>
				<lastmod>2020-06-04T14:10:45+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/fr/deutsch-lernen-online-kostenlos</loc>
				<lastmod>2020-06-04T14:10:46+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/vi/deutsch-lernen-online-kostenlos</loc>
				<lastmod>2020-06-04T14:10:46+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/deutsch-lernen-online-kostenlos/a1</loc>
				<lastmod>2020-06-04T14:10:45+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/deutsch-lernen-online-kostenlos/a2</loc>
				<lastmod>2020-06-04T14:10:45+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/deutsch-lernen-online-kostenlos/b1</loc>
				<lastmod>2020-06-04T14:10:46+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/deutsch-lernen-online-kostenlos/b2</loc>
				<lastmod>2020-06-04T14:10:46+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/deutsch-lernen-online-kostenlos/c1</loc>
				<lastmod>2020-06-04T14:10:46+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/en</loc>
				<lastmod>2020-06-04T14:10:47+00:00</lastmod>
				<priority>1.0</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/en/pruefung-anmelden</loc>
				<lastmod>2020-06-04T14:10:47+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/ru/pruefung-anmelden</loc>
				<lastmod>2020-06-04T14:10:48+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/tr/pruefung-anmelden</loc>
				<lastmod>2020-06-04T14:10:47+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/es/pruefung-anmelden</loc>
				<lastmod>2020-06-04T14:10:47+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/zh/pruefung-anmelden</loc>
				<lastmod>2020-06-04T14:10:49+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/fr/pruefung-anmelden</loc>
				<lastmod>2020-06-04T14:10:48+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/vi/pruefung-anmelden</loc>
				<lastmod>2020-06-04T14:10:48+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/pruefung-anmelden/5</loc>
				<lastmod>2020-06-04T14:10:49+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/pruefung-anmelden/6</loc>
				<lastmod>2020-06-04T14:10:49+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/pruefung-anmelden/7</loc>
				<lastmod>2020-06-04T14:10:49+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/pruefung-anmelden/8</loc>
				<lastmod>2020-06-04T14:10:49+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/pruefung-anmelden/9</loc>
				<lastmod>2020-06-04T14:10:49+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/pruefung-anmelden/10</loc>
				<lastmod>2020-06-04T14:10:50+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/pruefung-anmelden/16</loc>
				<lastmod>2020-06-04T14:10:51+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/pruefung-anmelden/17</loc>
				<lastmod>2020-06-04T14:10:50+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/pruefung-anmelden/18</loc>
				<lastmod>2020-06-04T14:10:50+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/pruefung-anmelden/19</loc>
				<lastmod>2020-06-04T14:10:50+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/ru</loc>
				<lastmod>2020-06-04T14:10:52+00:00</lastmod>
				<priority>1.0</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/en/zimmer-buchen</loc>
				<lastmod>2020-06-04T14:10:51+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/tr</loc>
				<lastmod>2020-06-04T14:10:53+00:00</lastmod>
				<priority>1.0</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/es</loc>
				<lastmod>2020-06-04T14:10:56+00:00</lastmod>
				<priority>1.0</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/zh</loc>
				<lastmod>2020-06-04T14:10:53+00:00</lastmod>
				<priority>1.0</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/fr</loc>
				<lastmod>2020-06-04T14:10:54+00:00</lastmod>
				<priority>1.0</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/vi</loc>
				<lastmod>2020-06-04T14:10:54+00:00</lastmod>
				<priority>1.0</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/en/agb</loc>
				<lastmod>2020-06-04T14:10:54+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/en/impressum</loc>
				<lastmod>2020-06-04T14:10:54+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/en/datenschutz</loc>
				<lastmod>2020-06-04T14:10:58+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/ru/zimmer-buchen</loc>
				<lastmod>2020-06-04T14:10:55+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/ru/agb</loc>
				<lastmod>2020-06-04T14:10:55+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/ru/impressum</loc>
				<lastmod>2020-06-04T14:10:56+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/ru/datenschutz</loc>
				<lastmod>2020-06-04T14:10:56+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/tr/zimmer-buchen</loc>
				<lastmod>2020-06-04T14:10:56+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/es/zimmer-buchen</loc>
				<lastmod>2020-06-04T14:10:57+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/zh/zimmer-buchen</loc>
				<lastmod>2020-06-04T14:11:02+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/fr/zimmer-buchen</loc>
				<lastmod>2020-06-04T14:10:57+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/vi/zimmer-buchen</loc>
				<lastmod>2020-06-04T14:10:57+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/tr/impressum</loc>
				<lastmod>2020-06-04T14:10:58+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/es/impressum</loc>
				<lastmod>2020-06-04T14:10:58+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/zh/impressum</loc>
				<lastmod>2020-06-04T14:10:59+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/fr/impressum</loc>
				<lastmod>2020-06-04T14:10:58+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/vi/impressum</loc>
				<lastmod>2020-06-04T14:10:59+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/tr/agb</loc>
				<lastmod>2020-06-04T14:10:59+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/es/agb</loc>
				<lastmod>2020-06-04T14:11:00+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/zh/agb</loc>
				<lastmod>2020-06-04T14:11:00+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/fr/agb</loc>
				<lastmod>2020-06-04T14:11:00+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/vi/agb</loc>
				<lastmod>2020-06-04T14:11:00+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/es/datenschutz</loc>
				<lastmod>2020-06-04T14:11:16+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/tr/datenschutz</loc>
				<lastmod>2020-06-04T14:11:19+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/zh/datenschutz</loc>
				<lastmod>2020-06-04T14:11:25+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/vi/datenschutz</loc>
				<lastmod>2020-06-04T14:11:29+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/deutschkurse-hannover-a1/register</loc>
				<lastmod>2020-06-04T14:11:29+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/en/deutschkurse-hannover-a1/register</loc>
				<lastmod>2020-06-04T14:11:32+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/ru/deutschkurse-hannover-a1/register</loc>
				<lastmod>2020-06-04T14:11:30+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/tr/deutschkurse-hannover-a1/register</loc>
				<lastmod>2020-06-04T14:11:30+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/es/deutschkurse-hannover-a1/register</loc>
				<lastmod>2020-06-04T14:11:31+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/zh/deutschkurse-hannover-a1/register</loc>
				<lastmod>2020-06-04T14:11:31+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/fr/deutschkurse-hannover-a1/register</loc>
				<lastmod>2020-06-04T14:11:31+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/vi/deutschkurse-hannover-a1/register</loc>
				<lastmod>2020-06-04T14:11:32+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/fr/datenschutz</loc>
				<lastmod>2020-06-04T14:11:32+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/deutschkurse-hannover-a2/register</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.8</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/en/deutschkurse-hannover-a2/register</loc>
				<lastmod>2020-06-04T14:12:14+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/ru/deutschkurse-hannover-a2/register</loc>
				<lastmod>2020-06-04T14:12:12+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/tr/deutschkurse-hannover-a2/register</loc>
				<lastmod>2020-06-04T14:12:12+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/es/deutschkurse-hannover-a2/register</loc>
				<lastmod>2020-06-04T14:12:13+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/zh/deutschkurse-hannover-a2/register</loc>
				<lastmod>2020-06-04T14:12:14+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/fr/deutschkurse-hannover-a2/register</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/vi/deutschkurse-hannover-a2/register</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/deutsch-lernen-online-kostenlos/a1/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/en/deutsch-lernen-online-kostenlos/a1/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/ru/deutsch-lernen-online-kostenlos/a1/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/es/deutsch-lernen-online-kostenlos/a1/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/fr/deutsch-lernen-online-kostenlos/a1/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/tr/deutsch-lernen-online-kostenlos/a1/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/vi/deutsch-lernen-online-kostenlos/a1/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/zh/deutsch-lernen-online-kostenlos/a1/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/deutsch-lernen-online-kostenlos/a2/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/en/deutsch-lernen-online-kostenlos/a2/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/ru/deutsch-lernen-online-kostenlos/a2/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/es/deutsch-lernen-online-kostenlos/a2/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/fr/deutsch-lernen-online-kostenlos/a2/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/tr/deutsch-lernen-online-kostenlos/a2/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/vi/deutsch-lernen-online-kostenlos/a2/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/zh/deutsch-lernen-online-kostenlos/a2/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/deutsch-lernen-online-kostenlos/b1/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/en/deutsch-lernen-online-kostenlos/b1/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/ru/deutsch-lernen-online-kostenlos/b1/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/es/deutsch-lernen-online-kostenlos/b1/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/fr/deutsch-lernen-online-kostenlos/b1/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/tr/deutsch-lernen-online-kostenlos/b1/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/vi/deutsch-lernen-online-kostenlos/b1/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/zh/deutsch-lernen-online-kostenlos/b1/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/deutsch-lernen-online-kostenlos/b2/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/en/deutsch-lernen-online-kostenlos/b2/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/ru/deutsch-lernen-online-kostenlos/b2/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/es/deutsch-lernen-online-kostenlos/b2/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/fr/deutsch-lernen-online-kostenlos/b2/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/tr/deutsch-lernen-online-kostenlos/b2/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/vi/deutsch-lernen-online-kostenlos/b2/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/zh/deutsch-lernen-online-kostenlos/b2/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/deutsch-lernen-online-kostenlos/c1/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/en/deutsch-lernen-online-kostenlos/c1/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/ru/deutsch-lernen-online-kostenlos/c1/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/es/deutsch-lernen-online-kostenlos/c1/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/fr/deutsch-lernen-online-kostenlos/c1/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/tr/deutsch-lernen-online-kostenlos/c1/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/vi/deutsch-lernen-online-kostenlos/c1/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
			<url>
				<loc>{{Request::server ("SERVER_NAME")}}/zh/deutsch-lernen-online-kostenlos/c1/personalpronomen</loc>
				<lastmod>2020-06-04T14:12:15+00:00</lastmod>
				<priority>0.6</priority>
			</url>
</urlset>